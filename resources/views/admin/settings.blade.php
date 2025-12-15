@extends('layouts.admin_layout')

@section('content')
    <h2 class="text-3xl font-light text-gray-800 border-b pb-4 mb-8">Pengaturan</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Informasi Website</h3>

            <div class="space-y-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Website</label>
                    <input type="text" id="site_name" name="site_name"
                           value="{{ old('site_name', $settings['site_name']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="e.g., Jemplore - Jember Explore" required>
                </div>

                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Website</label>
                    <textarea id="site_description" name="site_description" rows="3"
                              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                              placeholder="A brief description of the website." required>{{ old('site_description', $settings['site_description']) }}</textarea>
                </div>

                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="contact_email" name="contact_email"
                           value="{{ old('contact_email', $settings['contact_email']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900" required>
                </div>

                <div>
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor HP</label>
                    <input type="text" id="phone_number" name="phone_number"
                           value="{{ old('phone_number', $settings['phone_number']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900" required>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Pengaturan SEO</h3>

            <div class="space-y-6">
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">Kata Kunci Meta</label>
                    <input type="text" id="meta_keywords" name="meta_keywords"
                           value="{{ old('meta_keywords', $settings['meta_keywords']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="Separate keywords with commas">
                </div>

                <div>
                    <label for="ga_id" class="block text-sm font-medium text-gray-700 mb-1">ID Google Analytics</label>
                    <input type="text" id="ga_id" name="ga_id"
                           value="{{ old('ga_id', $settings['ga_id']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="e.g., GA-XXXXXXXXXX">
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Hero Section</h3>

            <div class="space-y-6">
                <div>
                    <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-1">Hero Title</label>
                    <input type="text" id="hero_title" name="hero_title"
                           value="{{ old('hero_title', $settings['hero_title']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="e.g., Discover the Hidden Beauty of">
                </div>

                <div>
                    <label for="hero_highlight" class="block text-sm font-medium text-gray-700 mb-1">Hero Highlight Text</label>
                    <input type="text" id="hero_highlight" name="hero_highlight"
                           value="{{ old('hero_highlight', $settings['hero_highlight']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="e.g., Jember">
                </div>

                <div>
                    <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-1">Hero Subtitle</label>
                    <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                              placeholder="A brief subtitle for the hero section">{{ old('hero_subtitle', $settings['hero_subtitle']) }}</textarea>
                </div>

                <div>
                    <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-1">Hero Background</label>

                    @if($settings['hero_image'])
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $settings['hero_image']) }}"
                                 alt="Current Hero Image"
                                 class="h-32 w-auto rounded-lg border border-gray-300 object-cover">
                            <p class="text-xs text-gray-500 mt-1">Gambar Saat Ini</p>
                        </div>
                    @endif

                    <input type="file" id="hero_image" name="hero_image" accept="image/*"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-1">Max size: 2MB. Formats: JPG, PNG, WEBP</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
            <h3 class="text-xl font-semibold text-gray-800 mb-6">Alasan Berkunjung Section</h3>

            <div class="space-y-6">
                <div>
                    <label for="why_visit_title" class="block text-sm font-medium text-gray-700 mb-1">Judul Section</label>
                    <input type="text" id="why_visit_title" name="why_visit_title"
                           value="{{ old('why_visit_title', $settings['why_visit_title']) }}"
                           class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                           placeholder="e.g., Why Visit Jember?">
                </div>

                <div>
                    <label for="why_visit_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Section</label>
                    <textarea id="why_visit_description" name="why_visit_description" rows="4"
                              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 text-gray-900"
                              placeholder="Describe why visitors should come to Jember">{{ old('why_visit_description', $settings['why_visit_description']) }}</textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="inline-flex items-center px-6 py-2.5 text-base font-medium rounded-lg text-white bg-teal-500 hover:bg-teal-600 transition shadow-md">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Simpan Perubahan
            </button>
        </div>

    </form>
@endsection
