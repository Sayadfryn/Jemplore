<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourismObject;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function manageProfile()
    {
        $user = Auth::user();

        $wisata = $user->tourismObject()->with(['category', 'tags', 'images'])->first();

        if (!$wisata) {
            return redirect()->route('owner.dashboard')->with('error', 'Anda belum memiliki data wisata.');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('owner.halkelolaprofil', compact('wisata', 'categories', 'tags'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'array|max:3',
            'thumbnail' => 'nullable|image|max:2048',
            'ticket_price' => 'nullable|string',
            'opening_hours' => 'nullable',
            'closing_hours' => 'nullable',
            'latitude' => 'required',
            'longitude' => 'required',
            'contact_number' => 'required|numeric',
        ]);

        $nomorHP = $request->contact_number;
        if (substr($nomorHP, 0, 1) === '0') {
            $nomorHP = '62' . substr($nomorHP, 1);
        } elseif (substr($nomorHP, 0, 2) !== '62') {
            $nomorHP = '62' . $nomorHP;
        }

        $payload = [
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
            'ticket_price' => $request->ticket_price,
            'opening_hours' => $request->opening_hours,
            'closing_hours' => $request->closing_hours,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'contact_number' => $nomorHP,
        ];

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('submissions', 'public');
            $payload['thumbnail'] = $path;
        }

        if ($request->hasFile('gallery')) {
            $galleryUpdates = [];
            foreach ($request->file('gallery') as $sortOrder => $file) {
                if ($file->isValid()) {
                    $path = $file->store('submissions', 'public');
                    $galleryUpdates[$sortOrder] = $path;
                }
            }
            if (!empty($galleryUpdates)) {
                $payload['gallery'] = $galleryUpdates;
            }
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $wisata->id,
            'submission_type' => 'update_profile',
            'payload' => $payload,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Perubahan profil telah diajukan.');
    }

    public function submissionStatus()
    {
        $user = Auth::user();

        $submissions = Submission::where('user_id', $user->id)
            ->latest()
            ->get();

        return view('owner.submission', compact('submissions'));
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $user->delete();

        return redirect()->route('public.home')->with('success', 'Akun Anda dan seluruh data wisata telah berhasil dihapus.');
    }
}
