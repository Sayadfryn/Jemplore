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
        $user = Auth::user();
        if ($user->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        $pendingSubmission = Submission::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingSubmission) {
            return view('user.submission_create', [
                'isPending' => true,
                'submission' => $pendingSubmission
            ]);
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
            'contact_number' => 'required|numeric',
        ]);

        $nomorHP = $request->contact_number;
        if (substr($nomorHP, 0, 1) === '0') {
            $nomorHP = '62' . substr($nomorHP, 1);
        }
        elseif (substr($nomorHP, 0, 2) !== '62') {
            $nomorHP = '62' . $nomorHP;
        }
        
        $payload = [
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'category_id' => $request->category_id,
            'tags' => $request->tags,
            'ticket_price' => $request->ticket_price,
            'contact_number' => $nomorHP,
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