<section class="w-full bg-gradient-to-br from-[#47b6c2]/5 via-[#98dce4]/10 to-[#5dd2de]/5 py-24 relative overflow-hidden">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <div class="flex flex-col gap-8 animate-fade-in-left">
                
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-[#060b0b] mb-4 leading-tight">
                        {{ \App\Models\Setting::get('why_visit_title', 'Why Visit Jember?') }}
                    </h2>
                    <p class="text-[#060b0b]/80 text-lg leading-relaxed font-light">
                        {{ \App\Models\Setting::get('why_visit_description', 'Nestled in East Java, Jember is a treasure trove of natural wonders and cultural richness. From the majestic Tumpak Sewu waterfall to the aromatic coffee plantations, every corner tells a unique story.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    
                    @php
                        $features = \App\Models\Setting::get('why_visit_features', [
                            ['text' => '50+ Destinations', 'icon' => 'map-pin'],
                            ['text' => 'Premium Coffee', 'icon' => 'coffee'],
                            ['text' => 'Growing Tourism', 'icon' => 'trending-up'],
                            ['text' => 'Year-round Events', 'icon' => 'calendar'],
                        ]);
                    @endphp

                    @foreach($features as $item)
                        <div class="flex items-center gap-4 p-2 rounded-xl transition hover:bg-white/50">
                            <div class="w-12 h-12 shrink-0 bg-[#47b6c2]/10 rounded-xl flex items-center justify-center text-[#47b6c2]">
                                @if($item['icon'] == 'map-pin')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                @elseif($item['icon'] == 'coffee')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 8h1a4 4 0 010 8h-1"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2 8h16v9a4 4 0 01-4 4H6a4 4 0 01-4-4V8z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 1v3"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 1v3"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 1v3"></path></svg>
                                @elseif($item['icon'] == 'trending-up')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                @elseif($item['icon'] == 'calendar')
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                @endif
                            </div>
                            
                            <span class="text-[#060b0b] font-medium text-lg">{{ $item['text'] }}</span>
                        </div>
                    @endforeach
                </div>

                <button class="bg-[#47b6c2] text-white px-8 py-3 rounded-xl font-medium shadow-lg hover:bg-[#3da0aa] hover:shadow-[#47b6c2]/30 transition w-fit mt-4">
                    Start Exploring
                </button>
            </div>

            <div class="relative h-[500px] w-full hidden lg:grid grid-cols-2 gap-4 animate-fade-in-right">
                
                <div class="rounded-2xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('storage/tumpak-sewu-vert.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Waterfall">
                </div>

                <div class="rounded-2xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('storage/papuma-vert.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Beach">
                </div>

                <div class="rounded-2xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('storage/foods.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Foods">
                </div>

                <div class="rounded-2xl overflow-hidden shadow-xl group">
                    <img src="{{ asset('storage/coffee-beans.png') }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="Coffee">
                </div>

                <div class="absolute -z-10 bg-[#47b6c2] w-64 h-64 rounded-full blur-[100px] opacity-20 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
            </div>

        </div>
    </div>
</section>