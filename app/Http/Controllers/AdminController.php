<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\TourismObject;
use App\Models\TourismObjectImage;
use App\Models\User;
use App\Models\Review;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', '!=', 'admin')->count();

        $totalDestinations = TourismObject::where('is_active', true)->count();

        $pendingCount = Submission::where('status', 'pending')->count();

        $totalReviews = Review::count();

        $traffic = 'N/A';

        return view('admin.admin_dashboard', compact(
            'totalUsers',
            'totalDestinations',
            'pendingCount',
            'totalReviews',
            'traffic'
        ));
    }

    public function verification()
    {
        $submissions = Submission::with(['user', 'tourismObject'])
            ->where('status', 'pending')
            ->oldest()
            ->paginate(10);

        return view('admin.verification', compact('submissions'));
    }

    public function approve($id)
    {
        $submission = Submission::findOrFail($id);
        $payload = $submission->payload;
        $message = 'Submission berhasil disetujui!';

        if ($submission->submission_type == 'create_new_tourism') {

            $tags = $payload['tags'] ?? [];
            unset($payload['tags']);

            $gallery = $payload['gallery'] ?? [];
            unset($payload['gallery']);

            $newWisata = TourismObject::create(array_merge($payload, [
                'user_id' => $submission->user_id,
                'is_active' => true,
            ]));

            if (!empty($tags)) {
                $newWisata->tags()->sync($tags);
            }

            if (!empty($gallery) && is_array($gallery)) {
                foreach ($gallery as $order => $path) {
                    TourismObjectImage::create([
                        'tourism_object_id' => $newWisata->id,
                        'sort_order' => $order,
                        'image_path' => $path
                    ]);
                }
            }

            $user = $submission->user;
            $user->role = 'owner';
            $user->save();

            $message = 'Disetujui! User sekarang resmi menjadi Owner dan Wisata baru telah dibuat.';
        }

        elseif ($submission->submission_type == 'update_profile') {

            $wisata = TourismObject::find($submission->tourism_object_id);

            if ($wisata) {

                if (isset($payload['gallery']) && is_array($payload['gallery'])) {
                    foreach ($payload['gallery'] as $order => $path) {
                        TourismObjectImage::updateOrCreate(
                            [
                                'tourism_object_id' => $wisata->id,
                                'sort_order' => $order
                            ],
                            [
                                'image_path' => $path
                            ]
                        );
                    }
                    unset($payload['gallery']);
                }

                if (isset($payload['tags']) && is_array($payload['tags'])) {
                    $wisata->tags()->sync($payload['tags']);
                    unset($payload['tags']);
                }

                $wisata->update($payload);
            }

            $message = 'Perubahan profil wisata berhasil disetujui dan diperbarui!';
        }

        elseif ($submission->submission_type == 'add_culinary') {
            \App\Models\Culinary::create(array_merge($payload, [
                'tourism_object_id' => $submission->tourism_object_id
            ]));
            $message = 'Menu kuliner baru telah ditambahkan!';
        }

        elseif ($submission->submission_type == 'update_culinary') {
            $culinary = \App\Models\Culinary::findOrFail($payload['target_id']);

            unset($payload['target_id']);
            // unset($payload['price_single']);

            if (isset($payload['image']) && $culinary->image) {
                Storage::disk('public')->delete($culinary->image);
            }

            $culinary->update($payload);
            $message = 'Data kuliner berhasil diperbarui!';
        }

        elseif ($submission->submission_type == 'add_event') {
            \App\Models\Event::create(array_merge($payload, [
                'tourism_object_id' => $submission->tourism_object_id
            ]));
            $message = 'Event baru telah diterbitkan!';
        }

        elseif ($submission->submission_type == 'update_event') {
            $event = \App\Models\Event::findOrFail($payload['target_id']);

            unset($payload['target_id']);

            if (isset($payload['image']) && $event->image) {
                Storage::disk('public')->delete($event->image);
            }

            $event->update($payload);
            $message = 'Data event berhasil diperbarui!';
        }

        elseif ($submission->submission_type == 'add_package') {
            \App\Models\Package::create(array_merge($payload, [
                'tourism_object_id' => $submission->tourism_object_id
            ]));
            $message = 'Paket wisata baru telah diterbitkan!';
        }

        elseif ($submission->submission_type == 'update_package') {
            $package = \App\Models\Package::findOrFail($payload['target_id']);
            unset($payload['target_id']);

            if (isset($payload['thumbnail']) && $package->thumbnail) {
                Storage::disk('public')->delete($package->thumbnail);
            }

            $package->update($payload);
            $message = 'Paket wisata berhasil diperbarui!';
        }

        $submission->update(['status' => 'approved']);

        return redirect()->back()->with('success', $message);
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'reason' => 'required|string|max:255'
        ]);

        $submission = Submission::findOrFail($id);

        $submission->update([
            'status' => 'rejected',
            'admin_feedback' => $request->reason
        ]);

        return redirect()->back()->with('error', 'Submission rejected.');
    }

    public function users(Request $request)
    {
        $query = User::query();

        if ($request->has('q')) {
            $query->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%');
        }

        $users = $query->where('id', '!=', auth()->id())
                        ->with('registrationSubmission')
                       ->latest()
                       ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'Pengguna berhasil dihapus.');
    }

    public function masterData()
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('admin.masterdata', compact('categories', 'tags'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
            'color' => 'required|string',
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'color' => $request->color
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    public function deleteCategory($id) {
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete category: ' . $e->getMessage());
        }
    }



    public function storeTag(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50|unique:tags,name',
        ]);

        Tag::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Tag added successfully!');
    }

    public function deleteTag($id) {
        try {
            $tag = Tag::findOrFail($id);
            $tag->delete();
            return redirect()->back()->with('success', 'Tag deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete tag: ' . $e->getMessage());
        }
    }

    public function settings()
    {
        $settings = [
            'site_name' => Setting::get('site_name', 'Jemplore - Jember Explore'),
            'site_description' => Setting::get('site_description', 'Discover the hidden beauty of Jember, Indonesia'),
            'contact_email' => Setting::get('contact_email', 'info@jemplore.id'),
            'phone_number' => Setting::get('phone_number', '+62 123 4567 890'),
            'meta_keywords' => Setting::get('meta_keywords', 'jember, tourism, indonesia, travel'),
            'ga_id' => Setting::get('ga_id', 'UA-XXXXXXXXX-X'),

            'hero_title' => Setting::get('hero_title', 'Discover the Hidden Beauty of'),
            'hero_highlight' => Setting::get('hero_highlight', 'Jember'),
            'hero_subtitle' => Setting::get('hero_subtitle', 'Explore breathtaking waterfalls, pristine beaches, and rich cultural heritage in the heart of East Java.'),
            'hero_image' => Setting::get('hero_image', 'hero-bg.png'),

            'why_visit_title' => Setting::get('why_visit_title', 'Why Visit Jember?'),
            'why_visit_description' => Setting::get('why_visit_description', 'Nestled in East Java, Jember is a treasure trove of natural wonders and cultural richness.'),
        ];

        return view('admin.settings', compact('settings'));
    }

    /**
     * Update settings
     */
    public function updateSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'contact_email' => 'required|email',
            'phone_number' => 'required|string|max:20',
            'meta_keywords' => 'nullable|string|max:255',
            'ga_id' => 'nullable|string|max:50',
            'hero_title' => 'nullable|string|max:255',
            'hero_highlight' => 'nullable|string|max:100',
            'hero_subtitle' => 'nullable|string|max:500',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'why_visit_title' => 'nullable|string|max:255',
            'why_visit_description' => 'nullable|string|max:1000',
        ]);

        try {
            Setting::set('site_name', $validated['site_name'], 'text', 'general');
            Setting::set('site_description', $validated['site_description'], 'textarea', 'general');
            Setting::set('contact_email', $validated['contact_email'], 'text', 'general');
            Setting::set('phone_number', $validated['phone_number'], 'text', 'general');

            Setting::set('meta_keywords', $validated['meta_keywords'] ?? '', 'text', 'seo');
            Setting::set('ga_id', $validated['ga_id'] ?? '', 'text', 'seo');

            if (isset($validated['hero_title'])) {
                Setting::set('hero_title', $validated['hero_title'], 'text', 'hero');
            }
            if (isset($validated['hero_highlight'])) {
                Setting::set('hero_highlight', $validated['hero_highlight'], 'text', 'hero');
            }
            if (isset($validated['hero_subtitle'])) {
                Setting::set('hero_subtitle', $validated['hero_subtitle'], 'textarea', 'hero');
            }

            if ($request->hasFile('hero_image')) {
                $oldImage = Setting::get('hero_image');

                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }

                $path = $request->file('hero_image')->store('', 'public');
                Setting::set('hero_image', $path, 'image', 'hero');
            }

            if (isset($validated['why_visit_title'])) {
                Setting::set('why_visit_title', $validated['why_visit_title'], 'text', 'why_visit');
            }
            if (isset($validated['why_visit_description'])) {
                Setting::set('why_visit_description', $validated['why_visit_description'], 'textarea', 'why_visit');
            }

            Setting::clearCache();

            return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }

    public function reports(Request $request)
    {
        $query = TourismObject::with(['user', 'reviews', 'culinaries.reviews', 'category'])
            ->where('is_active', true);

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhereHas('user', function($q2) use ($search) {
                    $q2->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            });
        }

        if ($request->has('category') && $request->category) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('min_rating') && $request->min_rating) {
            $minRating = (float) $request->min_rating;

            $query->where('rating', '>=', $minRating);
        }

        $tourismObjects = $query->paginate(15)->withQueryString();

        $stats = [
            'total_tourism' => TourismObject::where('is_active', true)->count(),
            'total_reviews' => Review::count(),
            'avg_rating' => number_format(Review::avg('rating') ?? 0, 2),
            'total_culinaries' => \App\Models\Culinary::count(),
        ];

        $categories = Category::all();

        return view('admin.reports', compact('tourismObjects', 'stats', 'categories'));
    }


    public function exportPDF(Request $request)
    {
        $tourismObjects = TourismObject::with(['user', 'reviews', 'culinaries.reviews', 'category'])
            ->where('is_active', true)
            ->get();

        $stats = [
            'total_tourism' => $tourismObjects->count(),
            'total_reviews' => Review::count(),
            'avg_rating' => number_format(Review::avg('rating') ?? 0, 2),
            'generated_at' => now()->format('d M Y H:i'),
        ];

        $pdf = PDF::loadView('admin.reports_pdf', compact('tourismObjects', 'stats'));

        return $pdf->download('tourism_report_' . date('Y-m-d') . '.pdf');
    }


    public function exportExcel()
    {
        $tourismObjects = TourismObject::with(['user', 'reviews', 'culinaries.reviews', 'category'])
            ->where('is_active', true)
            ->get();

        $filename = 'tourism_report_' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function() use ($tourismObjects) {
            $file = fopen('php://output', 'w');

            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'ID',
                'Nama Wisata',
                'Kategori',
                'Owner/Contact Person',
                'Email Owner',
                'Phone Number',
                'Average Rating',
                'Total Reviews',
                'Total Culinary Items',
                'Status',
                'Created At'
            ]);

            foreach ($tourismObjects as $tourism) {
                fputcsv($file, [
                    $tourism->id,
                    $tourism->name,
                    $tourism->category->name ?? 'N/A',
                    $tourism->user->name ?? 'N/A',
                    $tourism->user->email ?? 'N/A',
                    $tourism->contact_number ?? 'N/A',
                    number_format($tourism->global_rating, 2),
                    $tourism->global_review_count,
                    $tourism->culinaries->count(),
                    $tourism->is_active ? 'Active' : 'Inactive',
                    $tourism->created_at->format('d M Y'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getAllReviews(Request $request)
    {
        $query = Review::with(['user', 'tourismObject', 'culinary'])
            ->latest();

        if ($request->has('tourism_object_id') && $request->tourism_object_id) {
            $id = $request->tourism_object_id;

            $query->where(function($q) use ($id) {
                $q->where('tourism_object_id', $id)
                  ->orWhereHas('culinary', function($subQ) use ($id) {
                      $subQ->where('tourism_object_id', $id);
                  });
            });
        }

        if ($request->has('rating') && $request->rating) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->paginate(20)->withQueryString();

        return view('admin.all_reviews', compact('reviews'));
    }
}
