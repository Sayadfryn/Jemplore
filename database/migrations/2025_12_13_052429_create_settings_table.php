<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text');
            $table->string('group')->default('general');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'Jemplore - Jember Explore',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Website name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_description',
                'value' => 'Discover the hidden beauty of Jember, Indonesia',
                'type' => 'textarea',
                'group' => 'general',
                'description' => 'Website description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@jemplore.id',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Contact email address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'phone_number',
                'value' => '+62 123 4567 890',
                'type' => 'text',
                'group' => 'general',
                'description' => 'Contact phone number',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'meta_keywords',
                'value' => 'jember, tourism, indonesia, travel',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Meta keywords for SEO',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'ga_id',
                'value' => 'UA-XXXXXXXXX-X',
                'type' => 'text',
                'group' => 'seo',
                'description' => 'Google Analytics ID',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'hero_title',
                'value' => 'Discover the Hidden Beauty of',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section main title',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hero_highlight',
                'value' => 'Jember',
                'type' => 'text',
                'group' => 'hero',
                'description' => 'Hero section highlighted text',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hero_subtitle',
                'value' => 'Explore breathtaking waterfalls, pristine beaches, and rich cultural heritage in the heart of East Java.',
                'type' => 'textarea',
                'group' => 'hero',
                'description' => 'Hero section subtitle',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hero_image',
                'value' => 'hero-bg.png',
                'type' => 'image',
                'group' => 'hero',
                'description' => 'Hero section background image',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'key' => 'why_visit_title',
                'value' => 'Why Visit Jember?',
                'type' => 'text',
                'group' => 'why_visit',
                'description' => 'Why visit section title',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'why_visit_description',
                'value' => 'Nestled in East Java, Jember is a treasure trove of natural wonders and cultural richness. From the majestic Tumpak Sewu waterfall to the aromatic coffee plantations, every corner tells a unique story.',
                'type' => 'textarea',
                'group' => 'why_visit',
                'description' => 'Why visit section description',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'why_visit_features',
                'value' => json_encode([
                    ['text' => '50+ Destinasi', 'icon' => 'map-pin'],
                    ['text' => 'Premium Coffee', 'icon' => 'coffee'],
                    ['text' => 'Growing Tourism', 'icon' => 'trending-up'],
                    ['text' => 'Year-round Events', 'icon' => 'calendar'],
                ]),
                'type' => 'json',
                'group' => 'why_visit',
                'description' => 'Why visit features list',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
