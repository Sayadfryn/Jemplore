<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function create()
    {
        if (Auth::user()->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('user.submission_create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'proof_document' => 'required|file|mimes:pdf,jpg,png|max:5120', 
            'thumbnail' => 'required|image|max:2048',
            'gallery' => 'array|max:3',
            'gallery.*' => 'image|max:2048',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);
        
        $payload = [
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
            'ticket_price' => $request->ticket_price,
            'opening_hours' => $request->opening_hours,
            'closing_hours' => $request->closing_hours,
        ];

        if ($request->hasFile('thumbnail')) {
            $payload['thumbnail'] = $request->file('thumbnail')->store('submissions/thumbnails', 'public');
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

        $proofPath = $request->file('proof_document')->store('submissions/proofs', 'public');

        Submission::create([
            'user_id' => Auth::id(),
            'submission_type' => 'create_new_tourism',
            'payload' => $payload,
            'proof_document' => $proofPath, 
            'status' => 'pending'
        ]);

        return redirect()->route('public.home')
            ->with('success', 'Pengajuan Anda berhasil dikirim! Admin akan memverifikasi bukti kepemilikan Anda.');
    }
}