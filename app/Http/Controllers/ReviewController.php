<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\TourismObject;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tourism_object_id' => 'required|exists:tourism_objects,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $userId = Auth::id();
        $wisataId = $request->tourism_object_id;

        $existingReview = Review::where('user_id', $userId)
            ->where('tourism_object_id', $wisataId)
            ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'User hanya bisa beri ulasan satu kali per wisata.');
        }

        Review::create([
            'user_id' => $userId,
            'tourism_object_id' => $wisataId,
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        $this->recalculateWisataStats($wisataId);

        return redirect()->back()->with('success', 'Terima kasih! Ulasanmu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Ini bukan ulasanmu. Akses ditolak!');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        $this->recalculateWisataStats($review->tourism_object_id);

        return redirect()->back()->with('success', 'Ulasanmu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $wisataId = $review->tourism_object_id;
        $review->delete();

        $this->recalculateWisataStats($wisataId);

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    private function recalculateWisataStats($wisataId)
    {
        $wisata = TourismObject::find($wisataId);
        
        $avgRating = Review::where('tourism_object_id', $wisataId)->avg('rating');
        $totalReviews = Review::where('tourism_object_id', $wisataId)->count();

        $wisata->update([
            'rating' => $avgRating ?? 0,
            'total_reviews' => $totalReviews
        ]);
    }
}