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
        $message = 'Submission berhasil disetujui!';

        if ($submission->submission_type == 'create_new_tourism') {
            
            $payload = $submission->payload;
            
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

            $message = 'Approved! User sekarang resmi menjadi Owner dan Wisata baru telah dibuat.';
        }

        elseif ($submission->submission_type == 'update_profile') {
            
            $wisata = TourismObject::find($submission->tourism_object_id);

            if ($wisata) {
                $payload = $submission->payload;

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
                       ->latest()
                       ->paginate(10);

        return view('admin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success', 'User has been deleted successfully.');
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

            return redirect()->back()->with('success', 'Settings updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update settings: ' . $e->getMessage());
        }
    }
}