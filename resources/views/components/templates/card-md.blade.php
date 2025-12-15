@props(['data' => [], 'culinary' => false, 'event' => false, 'package' => false])

@php
    if ($culinary) {
        $route = 'public.culinary.profile';
    } elseif ($event) {
        $route = 'public.event.profile';
    } elseif ($package) {
        $route = 'public.package.profile';
    } else {
        $route = 'public.destination.show';
    }
@endphp

@foreach($data as $item)
    <a href="{{ route($route, $item['id']) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full">
        
        <div class="relative h-56 w-full overflow-hidden">
            <img src="{{ asset('storage/' . $item['image']) }}" 
                 alt="{{ $item['title'] }}" 
                 class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
            
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-60"></div>

            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                <span class="{{ $item['color'] }} text-white text-xs font-bold px-3 py-1.5 rounded-lg shadow-sm backdrop-blur-sm">
                    {{ $item['category'] }}
                </span>
                <span class="bg-white/90 text-[#060b0b] text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                    {{ $item['price'] }}
                </span>
            </div>
        </div>

        <div class="p-5 flex flex-col gap-3 flex-1">
            <h3 class="text-xl font-bold text-[#060b0b] leading-tight group-hover:text-[#47b6c2] transition-colors">
                {{ $item['title'] }}
            </h3>

            <div class="flex items-center justify-between text-sm text-gray-500">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>{{ $item['location'] }}</span>
                </div>
                
                <div class="flex items-center gap-1">
                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    <span class="text-[#060b0b] font-bold">{{ $item['rating'] }}</span>
                    <span class="text-xs text-gray-400">({{ $item['reviews'] }})</span>
                </div>
            </div>

            <div class="flex flex-wrap gap-2 mt-auto pt-4 border-t border-gray-100">
                @foreach($item['tags'] as $tag)
                    <span class="bg-[#98dce4]/10 text-[#47b6c2] text-xs font-medium px-2.5 py-1 rounded-md">
                        {{ $tag }}
                    </span>
                @endforeach
            </div>
        </div>
    </a>
@endforeach