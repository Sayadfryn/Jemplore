<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TourismObject;
use App\Models\Culinary;
use App\Models\Event;
use App\Models\Package;
use App\Models\Review;
use App\Models\TourismObjectImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Jemplore',
            'email' => '242410103050@mail.unej.ac.id',
            'role' => 'admin',
            'google_id' => '12345_admin', 
        ]);

        $mainOwner = User::factory()->create([
            'name' => 'Juragan Tumpak Sewu',
            'email' => 'rexiclaw@gmail.com',
            'role' => 'owner',
            'google_id' => '12345_owner',
        ]);

        User::factory()->create([
            'name' => 'Si Tukang Jalan',
            'email' => 'rivatdefryanto001@gmail.com',
            'role' => 'user',
            'google_id' => '12345_user',
        ]);
        
        $categories = [
            ['name' => 'Nature', 'color' => 'bg-[#47b6c2]'], 
            ['name' => 'Beach', 'color' => 'bg-blue-500'],
            ['name' => 'Culture', 'color' => 'bg-purple-500'],
            ['name' => 'Hiking', 'color' => 'bg-orange-500'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create([
                'name' => $cat['name'],
                'slug' => \Illuminate\Support\Str::slug($cat['name']),
                'color' => $cat['color']
            ]);
        }

        $tags = ['Hidden Gem', 'Pre-Wedding Spot', 'Sunset Spot', 'Family Friendly', 'Camping', 'History'];
        foreach ($tags as $tag) {
            \App\Models\Tag::create([
                'name' => $tag,
                'slug' => \Illuminate\Support\Str::slug($tag),
            ]);
        }

        $catNature = \App\Models\Category::where('slug', 'nature')->first();

        $mainWisata = TourismObject::factory()->create([
            'user_id' => $mainOwner->id,
            'category_id' => $catNature->id,
            'name' => 'Tumpak Sewu Waterfall',
            'thumbnail' => 'tumpak-sewu.png',
            'ticket_price' => 'Rp 20.000',
        ]);

        $tagIds = \App\Models\Tag::inRandomOrder()->limit(2)->pluck('id');
        $mainWisata->tags()->attach($tagIds);

        $this->seedWisataContent($mainWisata);

        
        $otherOwners = User::factory(5)->create([
            'role' => 'owner',
            'google_id' => fn() => 'google_' . fake()->unique()->uuid(), 
        ]);

        foreach ($otherOwners as $owner) {
            $wisata = TourismObject::factory()->create([
                'user_id' => $owner->id,
                'name' => fake()->city() . ' Paradise',
                'category_id' => fake()->numberBetween(1, 4),
            ]);

            $tagIds = \App\Models\Tag::inRandomOrder()->limit(2)->pluck('id');
            $wisata->tags()->attach($tagIds);

            $this->seedWisataContent($wisata);
        }

        Event::factory(3)->create([
            'tourism_object_id' => null,
            'title' => 'Jember Fashion Carnaval ' . date('Y'),
            'image' => 'carnaval.png',
        ]);

        Package::factory(5)->create();
    }

    private function seedWisataContent($wisata)
    {
        Culinary::factory(5)->create([
            'tourism_object_id' => $wisata->id,
        ]);

        Event::factory(2)->create([
            'tourism_object_id' => $wisata->id,
            'location_name' => $wisata->name,
        ]);

        Review::factory(10)->create([
            'tourism_object_id' => $wisata->id,
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
        ]);

        $galleryImages = ['tumpak-sewu.png', 'tumpak-sewu-vert.png', 'carnaval.png'];
        foreach($galleryImages as $index => $img) {
            TourismObjectImage::create([
                'tourism_object_id' => $wisata->id,
                'image_path' => $img, 
                'sort_order' => $index + 1, 
            ]);
        }
        
        $avg = $wisata->reviews()->avg('rating');
        $count = $wisata->reviews()->count();
        
        $wisata->update([
            'rating' => $avg,
            'total_reviews' => $count
        ]);
    }
}