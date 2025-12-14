@props(['destinations' => []])
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-bold text-[#060b0b]">Featured Destinations</h2>
            <p class="text-[#060b0b]/60 mt-2 text-base">Explore the most popular spots in Jember</p>
        </div>

        <a href="{{ route('public.destinations') }}" class="group flex items-center gap-2 text-[#47b6c2] font-medium hover:text-[#3da0aa] transition">
            View All
            <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <x-templates.card-md :data="$destinations" ></x-templates.card-md>
    </div>
</section>
