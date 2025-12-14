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
            'email' => env('AKUN_ADMIN') ?? '242410103000@mail.unej.ac.id',
            'role' => 'admin',
            'google_id' => '12345_admin',
        ]);

        // User::factory()->create([
        //     'name' => 'Admin Jemplore',
        //     'email' => env('AKUN_ADMIN') ?? '242410103050@mail.unej.ac.id',
        //     'role' => 'admin',
        //     'google_id' => '123456_admin',
        // ]);

        // User::factory()->create([
        //     'name' => 'Admin Jemplore',
        //     'email' => env('AKUN_ADMIN') ?? '242410103056@mail.unej.ac.id',
        //     'role' => 'admin',
        //     'google_id' => '1234567_admin',
        // ]);


        $mainOwner = User::factory()->create([
            'name' => 'Juragan Tumpak Sewu',
            'email' => env('AKUN_OWNER') ?? 'test@gmail.com',
            'role' => 'owner',
            'google_id' => '12345_owner',
        ]);

        // $mainOwner = User::factory()->create([
        //     'name' => 'Juragan Tumpak Sewu',
        //     'email' => env('AKUN_OWNER') ?? 'wullaannggraeni@gmail.com',
        //     'role' => 'owner',
        //     'google_id' => '1234567_owner',
        // ]);

        // $mainOwner = User::factory()->create([
        //     'name' => 'Juragan Tumpak Sewu',
        //     'email' => env('AKUN_OWNER') ?? 'rexiclaw@gmail.com',
        //     'role' => 'owner',
        //     'google_id' => '123456_owner',
        // ]);

        User::factory()->create([
            'name' => 'Si Tukang Jalan',
            'email' => env('AKUN_USER') ?? 'test2@gmail.com',
            'role' => 'user',
            'google_id' => '12345_user',
        ]);

        // User::factory()->create([
        //     'name' => 'Si Tukang Jalan',
        //     'email' => env('AKUN_USER') ?? 'rivatdefryanto001@gmail.com',
        //     'role' => 'user',
        //     'google_id' => '123456_user',
        // ]);

        // User::factory()->create([
        //     'name' => 'Si Tukang Jalan',
        //     'email' => env('AKUN_USER') ?? 'weeluelaen@gmail.com',
        //     'role' => 'user',
        //     'google_id' => '1234567_user',
        // ]);

        User::factory(20)->create([
            'role' => 'user',
            'google_id' => fn() => 'google_' . fake()->unique()->uuid(),
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
            'latitude' => -8.2323, 
            'longitude' => 112.9176,
        ]);

        $tagIds = \App\Models\Tag::inRandomOrder()->limit(2)->pluck('id');
        $mainWisata->tags()->attach($tagIds);

        $this->seedWisataContent($mainWisata);


        $otherOwners = User::factory(15)->create([
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

            \App\Models\Submission::create([
                'user_id' => $owner->id,
                'tourism_object_id' => $wisata->id,
                'submission_type' => 'create_new_tourism',
                'status' => 'approved',
                'payload' => [
                    'name' => $wisata->name,
                    'description' => $wisata->description
                ],
                'proof_document' => 'tumpak-sewu.png'
            ]);
        }

        // Event::factory(3)->create([
        //     'tourism_object_id' => null,
        //     'title' => 'Jember Fashion Carnaval ' . date('Y'),
        //     'image' => 'carnaval.png',
        // ]);

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

        $reviewers = User::where('id', '!=', $wisata->user_id)
                         ->inRandomOrder()
                         ->take(rand(5, 10))
                         ->get();

        foreach($reviewers as $reviewer) {
            Review::factory()->create([
                'tourism_object_id' => $wisata->id,
                'user_id' => $reviewer->id,
            ]);
        }

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
