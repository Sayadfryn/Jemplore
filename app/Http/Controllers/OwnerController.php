<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourismObject;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Submission;
use App\Models\Culinary;
use App\Models\Event;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{

    public function dashboard()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;
        
        $stats = [
            'rating' => 0,
            'reviews' => 0
        ];

        $reviews = Review::with(['user', 'culinary'])
            ->where(function($query) use ($wisata) {
                $query->where('tourism_object_id', $wisata->id)
                      ->orWhereHas('culinary', function($q) use ($wisata) {
                          $q->where('tourism_object_id', $wisata->id);
                      });
            })
            ->latest()
            ->get();
            
        $stats['reviews'] = $reviews->count();
        $stats['rating'] = round($reviews->avg('rating'), 2) ?? 0;

        return view('owner.dashboardowner', compact('stats'));
    }

    // ============ PROFIL ============
    public function manageProfile()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject()->with(['category', 'tags', 'images'])->first();

        // if (!$wisata) {
        //     return redirect()->route('owner.dashboard')->with('error', 'Anda belum memiliki data wisata.');
        // }

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

    // ============ KULINER ============
    public function manageCulinary()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        // if (!$wisata) {
        //     return redirect()->route('owner.dashboard')->with('error', 'Anda belum memiliki data wisata.');
        // }

        $culinaries = Culinary::where('tourism_object_id', $wisata->id)->get();

        return view('owner.manageculinary', compact('culinaries'));
    }

    public function storeCulinary(Request $request)
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'primary_tag' => 'required|string',
            'secondary_tags' => 'nullable|string',
            'price_type' => 'required|in:single,range',
            'price_single' => 'nullable|numeric|min:0', 
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|gt:price_min',
            'description' => 'nullable|string',
            'best_at' => 'nullable|string',
        ], [
            // Custom Error Message
            'price_max.gt' => 'Harga maksimal harus lebih tinggi dari harga minimal!',
            'price_single.min' => 'Harga tidak boleh negatif.',
            'price_min.min' => 'Harga minimum tidak boleh negatif.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('culinary', 'public');
        }

        // Convert secondary tags from comma-separated string to array
        $secondaryTags = null;
        if ($request->secondary_tags) {
            $secondaryTags = array_map('trim', explode(',', $request->secondary_tags));
            $secondaryTags = array_slice($secondaryTags, 0, 3); // Max 3 tags
        }

        $data = [
            'tourism_object_id' => $wisata->id,
            'name' => $request->name,
            'image' => $imagePath,
            'primary_tag' => $request->primary_tag,
            'secondary_tags' => $secondaryTags,
            'price_type' => $request->price_type,
            'description' => $request->description,
            'best_at' => $request->best_at,
        ];

        if ($request->price_type === 'single') {
            $data['price'] = $request->price_single;
            $data['min_price'] = null;
            $data['max_price'] = null;
        } else {
            $data['price'] = null;
            $data['min_price'] = $request->price_min;
            $data['max_price'] = $request->price_max;
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $wisata->id,
            'submission_type' => 'add_culinary',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Menu kuliner berhasil diajukan! Menunggu verifikasi admin.');
    }

    public function updateCulinary(Request $request, $id)
    {
        $user = Auth::user();
        $culinary = Culinary::where('id', $id)
            ->whereHas('tourismObject', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'primary_tag' => 'required|string',
            'secondary_tags' => 'nullable|string',
            'price_type' => 'required|in:single,range',
            'price_single' => 'nullable|numeric|min:0', 
            'price_min' => 'nullable|numeric|min:0',
            'price_max' => 'nullable|numeric|gt:price_min',
            'description' => 'nullable|string',
            'best_at' => 'nullable|string',
        ], [
            // Custom Error Message
            'price_max.gt' => 'Harga maksimal harus lebih tinggi dari harga minimal!',
            'price_single.min' => 'Harga tidak boleh negatif.',
            'price_min.min' => 'Harga minimum tidak boleh negatif.',
        ]);

        if ($request->hasFile('image')) {
            if ($culinary->image) {
                Storage::disk('public')->delete($culinary->image);
            }
            $culinary->image = $request->file('image')->store('culinary', 'public');
        }

        // Convert secondary tags
        $secondaryTags = null;
        if ($request->secondary_tags) {
            $secondaryTags = array_map('trim', explode(',', $request->secondary_tags));
            $secondaryTags = array_slice($secondaryTags, 0, 3);
        }

        $data = [
            'name' => $request->name,
            'primary_tag' => $request->primary_tag,
            'secondary_tags' => $secondaryTags,
            'price_type' => $request->price_type,
            'description' => $request->description,
            'best_at' => $request->best_at,
        ];

        $data['target_id'] = $id;

        if ($request->price_type === 'single') {
            $data['price'] = $request->price_single;
            $data['min_price'] = null;
            $data['max_price'] = null;
        } else {
            $data['price'] = null;
            $data['min_price'] = $request->price_min;
            $data['max_price'] = $request->price_max;
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $user->tourismObject->id,
            'submission_type' => 'update_culinary',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Perubahan kuliner diajukan. Menunggu verifikasi.');
    }

    public function deleteCulinary($id)
    {
        $user = Auth::user();
        $culinary = Culinary::where('id', $id)
            ->whereHas('tourismObject', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->firstOrFail();

        if ($culinary->image) {
            Storage::disk('public')->delete($culinary->image);
        }

        $culinary->delete();

        return redirect()->route('owner.culinary.manage')
            ->with('success', 'Item kuliner berhasil dihapus.');
    }

    // ============ EVENT ============
    public function manageEvents()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        // if (!$wisata) {
        //     return redirect()->route('owner.dashboard')->with('error', 'Anda belum memiliki data wisata.');
        // }

        $events = Event::where('tourism_object_id', $wisata->id)->orderBy('start_date', 'desc')->get();

        return view('owner.manageevents', compact('events'));
    }

    public function storeEvent(Request $request)
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'location_name' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['_token', 'image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('submissions/events', 'public');
        }

        if(empty($data['location_name'])) {
            $data['location_name'] = $wisata->name;
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $wisata->id,
            'submission_type' => 'add_event',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Event baru berhasil diajukan. Menunggu verifikasi.');
    }

    public function updateEvent(Request $request, $id)
    {
        $user = Auth::user();
        $event = Event::where('id', $id)
            ->whereHas('tourismObject', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->firstOrFail();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'start_time' => 'nullable',
            'location_name' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['_token', 'image', '_method']);
        $data['target_id'] = $id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('submissions/events', 'public');
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $user->tourismObject->id,
            'submission_type' => 'update_event',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Update event diajukan.');
    }

    public function deleteEvent($id)
    {
        $user = Auth::user();
        $event = Event::where('id', $id)
            ->whereHas('tourismObject', function($q) use ($user) {
                $q->where('user_id', $user->id);
            })->firstOrFail();

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()->route('owner.events.manage')
            ->with('success', 'Event berhasil dihapus.');
    }

    // ==========================================
    // MANAGE PACKAGES
    // ==========================================

    public function managePackages()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        $packages = \App\Models\Package::where('tourism_object_id', $wisata->id)
            ->latest()
            ->get();

        return view('owner.managepackages', compact('packages'));
    }

    public function storePackage(Request $request)
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
            'features' => 'required|string',
        ]);

        $data = $request->except(['_token', 'thumbnail', 'features']);
        
        $featuresArray = array_filter(array_map('trim', explode("\n", $request->features)));
        $data['features'] = array_values($featuresArray);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('submissions/packages', 'public');
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $wisata->id,
            'submission_type' => 'add_package',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Paket wisata berhasil diajukan! Menunggu verifikasi admin.');
    }

    public function updatePackage(Request $request, $id)
    {
        $user = Auth::user();
        $package = \App\Models\Package::where('id', $id)
            ->where('tourism_object_id', $user->tourismObject->id)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|max:2048',
            'features' => 'required|string',
        ]);

        $data = $request->except(['_token', 'thumbnail', 'features', '_method']);
        $data['target_id'] = $id; 

        $featuresArray = array_filter(array_map('trim', explode("\n", $request->features)));
        $data['features'] = array_values($featuresArray);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('submissions/packages', 'public');
        }

        Submission::create([
            'user_id' => $user->id,
            'tourism_object_id' => $user->tourismObject->id,
            'submission_type' => 'update_package',
            'payload' => $data,
            'status' => 'pending'
        ]);

        return redirect()->route('owner.submission.status')
            ->with('success', 'Perubahan paket diajukan.');
    }

    public function deletePackage($id)
    {
        $user = Auth::user();
        $package = \App\Models\Package::where('id', $id)
            ->where('tourism_object_id', $user->tourismObject->id)
            ->firstOrFail();

        if ($package->thumbnail) {
            Storage::disk('public')->delete($package->thumbnail);
        }

        $package->delete();

        return redirect()->back()->with('success', 'Paket wisata berhasil dihapus.');
    }

    // ============ KINERJA ============
    public function performance()
    {
        $user = Auth::user();
        $wisata = $user->tourismObject;

        // if (!$wisata) {
        //     return redirect()->route('owner.dashboard')->with('error', 'Anda belum memiliki data wisata.');
        // }

        // Get all reviews for this tourism object
        $reviews = Review::with(['user', 'culinary'])
            ->where(function($query) use ($wisata) {
                $query->where('tourism_object_id', $wisata->id)
                      ->orWhereHas('culinary', function($q) use ($wisata) {
                          $q->where('tourism_object_id', $wisata->id);
                      });
            })
            ->latest()
            ->get();

        // Calculate statistics
        $totalReviews = $reviews->count();
        $averageRating = $totalReviews > 0 ? round($reviews->avg('rating'), 2) : 0;
        $totalRating = $reviews->sum('rating');

        // Rating distribution
        $ratingDistribution = [
            5 => $reviews->where('rating', 5)->count(),
            4 => $reviews->where('rating', 4)->count(),
            3 => $reviews->where('rating', 3)->count(),
            2 => $reviews->where('rating', 2)->count(),
            1 => $reviews->where('rating', 1)->count(),
        ];

        // Recent reviews
        $recentReviews = $reviews->take(5);

        return view('owner.performance', compact(
            'totalReviews',
            'averageRating',
            'totalRating',
            'ratingDistribution',
            'recentReviews'
        ));
    }

    // ============ SUBMISSION & ACCOUNT ============
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
