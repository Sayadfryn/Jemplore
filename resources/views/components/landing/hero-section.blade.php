<section class="relative w-full h-[600px] lg:h-[700px] bg-cover bg-center group" 
    style="background-image: url('{{ asset('storage/' . \App\Models\Setting::get('hero_image', 'hero-bg.png')) }}');">
    
    <div class="absolute inset-0 bg-gradient-to-r from-[#060b0b]/80 via-[#060b0b]/50 to-transparent"></div>

    <div class="relative z-10 h-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col justify-center items-center pt-20">
        
        <div class="max-w-6xl animate-fade-in-up text-center flex flex-col items-center">
            <h1 class="text-white text-5xl md:text-6xl lg:text-7xl font-bold leading-tight tracking-tight mb-2">
                {{ \App\Models\Setting::get('hero_title', 'Discover the Hidden Beauty of') }} <br>
                <span class="text-[#5dd2de]">{{ \App\Models\Setting::get('hero_highlight', 'Jember') }}</span>
            </h1>

            <p class="text-[#f9fcfd] text-lg md:text-xl font-light mt-6 max-w-2xl leading-relaxed">
                {{ \App\Models\Setting::get('hero_subtitle', 'Explore breathtaking waterfalls, pristine beaches, and rich cultural heritage in the heart of East Java.') }}
            </p>
        </div>

        <form action="/search" method="GET" class="mt-10 w-full max-w-2xl bg-white p-2 rounded-2xl shadow-2xl flex items-center gap-2 transform transition hover:scale-[1.01]">
            
            <div class="pl-4 text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            <input 
                type="search" 
                name="q" 
                class="flex-1 h-12 bg-transparent border-none focus:ring-0 text-gray-700 placeholder-gray-400 text-base"
                placeholder="Search destinations, culinary, events..."
                autocomplete="off"
            >

            <button type="submit" class="bg-[#47b6c2] hover:bg-[#3da0aa] text-white px-8 py-3 rounded-xl font-medium transition-all shadow-lg hover:shadow-[#47b6c2]/30 active:scale-95">
                Search
            </button>
        </form>

    </div>
</section>