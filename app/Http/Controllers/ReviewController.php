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
            'tourism_object_id' => 'nullable|exists:tourism_objects,id',
            'culinary_id'       => 'nullable|exists:culinaries,id',
            'rating'            => 'required|integer|min:1|max:5',
            'comment'           => 'required|string|max:500',
        ]);

        $userId = Auth::id();
        $query = Review::where('user_id', $userId);
        
        if ($request->has('culinary_id') && $request->culinary_id) {
            $query->where('culinary_id', $request->culinary_id);
            $targetType = 'culinary';
        } else {
            $query->where('tourism_object_id', $request->tourism_object_id);
            $targetType = 'tourism';
        }

        if ($query->exists()) {
            return redirect()->back()->with('error', 'Kamu sudah memberikan ulasan untuk item ini.');
        }

        Review::create([
            'user_id' => $userId,
            'tourism_object_id' => $request->tourism_object_id,
            'culinary_id' => $request->culinary_id,             
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        if ($targetType == 'culinary') {
            $this->recalculateCulinaryStats($request->culinary_id);
        } else {
            $this->recalculateWisataStats($request->tourism_object_id);
        }

        return redirect()->back()->with('success', 'Terima kasih! Ulasanmu berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Ini bukan ulasanmu. Akses ditolak!');
        }

        if ($review->culinary_id) {
            $targetType = 'culinary';
        } else {
            $targetType = 'tourism';
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment
        ]);

        if ($targetType == 'culinary') {
            $this->recalculateCulinaryStats($request->culinary_id);
        } else {
            $this->recalculateWisataStats($request->tourism_object_id);
        }

        return redirect()->back()->with('success', 'Ulasanmu berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $review->delete();

        if ($review->culinary_id) {
            $this->recalculateCulinaryStats($review->culinary_id);
        } else {
            $this->recalculateWisataStats($review->tourism_object_id);
        }

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

    private function recalculateCulinaryStats($culinaryId)
    {
        $culinary = \App\Models\Culinary::find($culinaryId);
        if ($culinary) {
            $avgRating = Review::where('culinary_id', $culinaryId)->avg('rating');
            $totalReviews = Review::where('culinary_id', $culinaryId)->count();

            $culinary->update([
                'rating' => $avgRating ?? 0,
                'total_reviews' => $totalReviews
            ]);
        }
    }
}