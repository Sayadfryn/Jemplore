<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourismObject;
use App\Models\Event;
use App\Models\Package;
use Carbon\Carbon;
use App\Models\Culinary;

class PublicController extends Controller
{
    public function index()
    {
        $destinations = TourismObject::with(['category', 'tags'])
            ->where('is_active', true)
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->name,
                    
                    'category' => $item->category ? $item->category->name : 'General',
                    'color' => $item->category ? $item->category->color : 'bg-gray-500',
                    
                    'price' => $item->ticket_price ?? 'Free',
                    
                    'location' => $item->address,
                    'rating' => (float) $item->rating,
                    'reviews' => (int) $item->total_reviews,
                    
                    'image' => $item->thumbnail ?? 'tumpak-sewu.jpg',
                    
                    'tags' => $item->tags->pluck('name')->toArray(),
                ];
            });

        $events = Event::where('start_date', '>=', now())
            ->orderBy('start_date', 'asc')
            ->take(2)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'description' => $item->description,
                    
                    'date' => Carbon::parse($item->start_date)->format('M d, Y'),
                    
                    'time' => $item->start_time ? Carbon::parse($item->start_time)->format('h:i A') : 'All Day',
                    
                    'location' => $item->location_name,
                    'image' => $item->image ?? 'carnaval.jpg',
                    
                    'category' => 'Event', 
                ];
            });

        return view('landing', [
            'destinations' => $destinations,
            'events' => $events
        ]);
    }

    public function destination(Request $request)
    {
        $query = TourismObject::with(['category', 'tags'])
            ->where('is_active', true);

        if ($request->has('q') && $request->q != '') {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('address', 'like', "%{$keyword}%");
            });
        }

        if ($request->has('category') && $request->category != 'All') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('name', $request->category);
            });
        }

        $destinations = $query->latest()->paginate(9)->withQueryString();

        $destinations->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->name,
                'category' => $item->category ? $item->category->name : 'General',
                'color' => $item->category ? $item->category->color : 'bg-gray-500',
                'price' => $item->ticket_price ?? 'Free',
                'location' => $item->address,
                'rating' => (float) $item->rating,
                'reviews' => (int) $item->total_reviews,
                'image' => $item->thumbnail ?? 'tumpak-sewu.jpg',
                'tags' => $item->tags->pluck('name')->toArray(),
            ];
        });

        return view('destination', compact('destinations'));
    }

    public function culinary(Request $request)
    {
        $query = Culinary::with(['tourismObject']);

        if ($request->has('q') && $request->q != '') {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%")
                  ->orWhereJsonContains('secondary_tags', $keyword);
            });
        }

        if ($request->has('category') && $request->category != 'All') {
            $query->where('primary_tag', $request->category);
        }

        $culinaries = $query->latest()->paginate(9)->withQueryString();

        $culinaries->getCollection()->transform(function ($item) {
            
            if ($item->price_type === 'range') {
                $price = 'Rp ' . number_format($item->min_price, 0, ',', '.') . ' - ' . number_format($item->max_price, 0, ',', '.');
            } else {
                $price = 'Rp ' . number_format($item->price, 0, ',', '.');
            }

            $colors = [
                'Traditional' => 'bg-orange-500',
                'Modern' => 'bg-purple-500',
                'Snack' => 'bg-yellow-500',
                'Beverage' => 'bg-blue-500',
                'Spicy' => 'bg-red-500',
            ];
            $badgeColor = $colors[$item->primary_tag] ?? 'bg-[#47b6c2]';

            return [
                'id' => $item->id,
                'title' => $item->name,
                'category' => $item->primary_tag,
                'color' => $badgeColor,
                'price' => $price,
                
                'location' => $item->tourismObject ? $item->tourismObject->name : 'Jember Area',
                
                'rating' => (float) $item->rating,
                'reviews' => (int) $item->total_reviews,
                'image' => $item->image ?? 'foods.png',
                
                'tags' => $item->secondary_tags ?? [],
            ];
        });

        return view('culinary', compact('culinaries'));
    }

    public function event(Request $request)
    {
        $query = Event::where('start_date', '>=', now());

        if ($request->has('q') && $request->q != '') {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'like', "%{$keyword}%")
                  ->orWhere('location_name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $events = $query->orderBy('start_date', 'asc')
                        ->paginate(5)
                        ->withQueryString();

        $events->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'description' => $item->description,
                'image' => $item->image ?? 'carnaval.jpg',
                
                'date' => Carbon::parse($item->start_date)->format('M d, Y'),
                
                'time' => $item->start_time ? Carbon::parse($item->start_time)->format('h:i A') : 'All Day',
                
                'location' => $item->location_name,
                
                'category' => 'Festival', 
            ];
        });

        return view('event', compact('events'));
    }

    public function package(Request $request)
    {
        $query = Package::query();

        if ($request->has('q') && $request->q != '') {
            $keyword = $request->q;
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        $packages = $query->latest()->paginate(6)->withQueryString();

        $packages->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->name,
                'price' => 'Rp ' . number_format($item->price, 0, ',', '.'),
                
                'duration' => '3 Days 2 Nights',
                'pax' => '2-8 people',
                
                'rating' => 4.8,
                'reviews' => 120,
                
                'features' => $item->features ?? [],
                
                'image' => $item->thumbnail ?? 'argopuro-mountain.jpg',
            ];
        });

        return view('tour-package', compact('packages'));
    }

    public function show(Request $request, $id)
    {
        $wisata = TourismObject::with(['category', 'tags', 'images', 'events'])
            ->findOrFail($id);

        $query = $wisata->reviews()->with('user');

        // Filter
        if ($request->has('rating') && $request->rating != 'all') {
            $query->where('rating', $request->rating);
        }

        // Sort
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'highest':
                $query->orderBy('rating', 'desc');
                break;
            case 'lowest':
                $query->orderBy('rating', 'asc');
                break;
            default: // Default: Newest
                $query->latest();
                break;
        }

        $reviews = $query->paginate(5)->withQueryString();

        $reviews->getCollection()->transform(function ($review) {
            return [
                'id' => $review->id,
                'user_id' => $review->user_id,
                'name' => $review->user->name,
                'initial' => substr($review->user->name, 0, 1),
                'timeAgo' => $review->created_at->diffForHumans(),
                'rating' => $review->rating,
                'comment' => $review->comment,
            ];
        });

        $events = $wisata->events
            ->where('start_date', '>=', now())
            ->sortBy('start_date')
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'date' => Carbon::parse($event->start_date)->format('F d, Y'),
                    'image' => $event->image ?? 'carnaval.jpg',
                ];
            });

        $byCategory = TourismObject::where('category_id', $wisata->category_id)
            ->where('id', '!=', $wisata->id)
            ->where('is_active', true)
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        $byTags = TourismObject::whereHas('tags', function ($q) use ($wisata) {
                $q->whereIn('tags.id', $wisata->tags->pluck('id'));
            })
            ->where('id', '!=', $wisata->id)
            ->where('is_active', true)
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        $byRandom = TourismObject::where('id', '!=', $wisata->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(3)
            ->get();

        $relatedDestinations = $byCategory
            ->concat($byTags)
            ->concat($byRandom)
            ->unique('id')
            ->take(3);

        return view('destination-profile', compact('wisata', 'events', 'reviews', 'relatedDestinations'));
    }
}