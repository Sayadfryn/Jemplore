@props(['data' => []])

@foreach($data as $item)
    <a href="{{ route('public.event.profile', $item['id']) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col md:flex-row h-full">
        
        <div class="w-full md:w-[350px] h-[250px] md:h-auto relative shrink-0 overflow-hidden">
            <img src="{{ asset('storage/' . $item['image']) }}" 
                 alt="{{ $item['title'] }}" 
                 class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
            
            <div class="absolute top-4 left-4 bg-[#47b6c2] rounded-lg px-3 py-1.5 shadow-md z-10">
                <span class="text-white text-xs font-bold tracking-wide uppercase">
                    {{ $item['category'] }}
                </span>
            </div>

            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
        </div>

        <div class="flex flex-col justify-center p-6 md:p-8 gap-6 flex-1">
            
            <div class="flex flex-col gap-2">
                <h2 class="text-[#060b0b] text-2xl md:text-3xl font-bold leading-tight group-hover:text-[#47b6c2] transition-colors">
                    {{ $item['title'] }}
                </h2>
                <p class="text-[#060b0b]/70 text-base leading-relaxed line-clamp-2">
                    {{ $item['description'] }}
                </p>
            </div>

            <div class="flex flex-col gap-3 border-t border-gray-100 pt-5">
                
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="text-gray-600 text-sm md:text-base font-medium">
                        {{ $item['date'] }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-gray-600 text-sm md:text-base font-medium">
                        {{ $item['time'] }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span class="text-gray-600 text-sm md:text-base font-medium">
                        {{ $item['location'] }}
                    </span>
                </div>
            </div>

            <div class="mt-2">
                <button class="px-8 py-2.5 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-xl font-bold shadow-lg shadow-[#47b6c2]/30 transition-all active:scale-95 flex items-center gap-2 w-fit">
                    Learn More
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
            </div>

        </div>
    </a>
@endforeach