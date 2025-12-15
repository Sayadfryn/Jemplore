@props(['data' => []])
@foreach($data as $item)
    <a href="{{ route('public.package.profile', $item['id']) }}" class="flex flex-col w-full bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 group h-full">
        
        <div class="h-64 w-full relative overflow-hidden">
            <img src="{{ asset('storage/' . $item['image']) }}" 
                    alt="{{ $item['title'] }}" 
                    class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
            
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>

            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-2 rounded-full shadow-lg z-10">
                <span class="text-[#47b6c2] text-base font-bold">
                    {{ $item['price'] }}
                </span>
            </div>
        </div>

        <div class="p-6 md:p-8 flex flex-col gap-6 flex-1">
            
            <h2 class="text-[#060b0b] text-2xl font-bold leading-tight group-hover:text-[#47b6c2] transition-colors">
                {{ $item['title'] }}
            </h2>

            <div class="flex flex-wrap items-center gap-y-3 gap-x-6 text-[#060b0b]/70">
                
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="text-sm font-medium">{{ $item['duration'] }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span class="text-sm font-medium">{{ $item['pax'] }}</span>
                </div>

                <div class="flex items-center gap-1">
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="text-[#060b0b] font-bold text-sm">{{ $item['rating'] }}</span>
                    <span class="text-sm">({{ $item['reviews'] }})</span>
                </div>
            </div>

            <ul class="flex flex-col gap-3 flex-1 mt-2">
                @foreach($item['features'] as $feature)
                    <li class="flex items-start gap-3">
                        <div class="flex-shrink-0 w-5 h-5 bg-[#47b6c2]/10 rounded-full flex items-center justify-center mt-0.5">
                            <svg class="w-3 h-3 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <span class="text-[#060b0b]/80 text-sm">
                            {{ $feature }}
                        </span>
                    </li>
                @endforeach
            </ul>

            <button class="w-full mt-4 py-3.5 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-xl transition-all shadow-lg shadow-[#47b6c2]/20 font-bold text-sm active:scale-95">
                View Details & Book
            </button>

        </div>
    </a>
@endforeach