@props(['wisata', 'reviews' => [], 'events' => [], 'related' => []])
<div class="container mx-auto px-4 max-w-[1315px] h-[calc(100vh-150px)] overflow-hidden">
    
    <div class="flex flex-col lg:flex-row gap-8 h-full">
        
        <div class="flex-1 w-full lg:w-[827px] h-full overflow-y-auto pr-2 pb-20 custom-scrollbar">
            
            <div class="relative w-full h-[300px] md:h-[500px] rounded-2xl overflow-hidden mb-6 group shrink-0">
                <img src="{{ asset('storage/' . ($wisata->thumbnail ?? 'tumpak-sewu.jpg')) }}" 
                     alt="{{ $wisata->name }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                    @if($wisata->category)
                        <span class="{{ $wisata->category->color }} text-white px-3 py-1 rounded-full text-xs font-medium">
                            {{ $wisata->category->name }}
                        </span>
                    @endif
                    
                    @foreach($wisata->tags as $tag)
                        <span class="bg-white/90 backdrop-blur text-[#060b0b] px-3 py-1 rounded-full text-xs font-medium">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-[#060b0b] mb-3">{{ $wisata->name }}</h1>
                
                <div class="flex flex-wrap items-center gap-4 text-[#060b0b]/60 text-sm">
                    <div class="flex items-center gap-1">
                        <svg class="w-5 h-5 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $wisata->address }}</span>
                    </div>

                    <div class="flex items-center gap-1">
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="font-bold text-[#060b0b]">{{ $wisata->rating }}</span>
                        <span>({{ $wisata->total_reviews }} reviews)</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8" id="overview">
                <h2 class="text-xl font-bold text-[#060b0b] mb-4">About This Place</h2>
                <p class="text-[#060b0b]/80 leading-relaxed mb-6 whitespace-pre-line">
                    {{ $wisata->description }}
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="p-2 bg-[#47b6c2]/10 rounded-lg text-[#47b6c2]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-[#060b0b]/60">Operating Hours</p>
                            <p class="font-medium text-[#060b0b]">
                                {{ \Carbon\Carbon::parse($wisata->opening_hours)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($wisata->closing_hours)->format('H:i') }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-lg">
                        <div class="p-2 bg-[#47b6c2]/10 rounded-lg text-[#47b6c2]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-[#060b0b]/60">Entry Fee</p>
                            <p class="font-medium text-[#060b0b]">{{ $wisata->ticket_price }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-20">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-[#060b0b]">Location</h2>
                    
                    <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->latitude }},{{ $wisata->longitude }}" 
                    target="_blank"
                    class="text-sm text-[#47b6c2] hover:underline flex items-center gap-1">
                        Open in Google Maps <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>

                <div id="map-detail" class="w-full h-[350px] rounded-xl border border-gray-200 z-0 shadow-inner"></div>
                
                <div class="mt-4 flex items-start gap-3 text-[#060b0b]/70">
                    <svg class="w-5 h-5 text-[#47b6c2] mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span class="text-sm leading-relaxed">{{ $wisata->address }}</span>
                </div>
            </div>

            <x-destination.reviews-section :reviews="$reviews" :wisata="$wisata"/>

            <x-destination.events-section :events="$events" />

        </div>

        <div class="w-full lg:w-[400px] h-full overflow-y-auto pb-20 custom-scrollbar pr-2 flex flex-col gap-6">
            
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 sticky top-0 z-20">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <p class="text-sm text-[#060b0b]/60">Entry Fee</p>
                        <p class="text-2xl font-bold text-[#47b6c2]">{{ $wisata->ticket_price }}</p>
                    </div>
                </div>
                
                <button class="w-full bg-[#47b6c2] hover:bg-[#3da5b1] text-white py-3 rounded-xl font-bold mb-3 transition-colors shadow-lg shadow-[#47b6c2]/20">
                    Book Now
                </button>
                <div class="flex gap-2">
                    <button class="flex-1 border border-[#47b6c2] text-[#47b6c2] py-2 rounded-xl font-medium hover:bg-cyan-50 transition-colors">
                        Share
                    </button>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg mb-4">Gallery</h3>
                
                <div class="flex flex-col gap-3">
                    @forelse($wisata->images as $img)
                        <div class="relative w-full h-48 rounded-xl overflow-hidden group cursor-pointer">
                            <img src="{{ asset('storage/' . $img->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                    @empty
                        <div class="text-center text-gray-400 py-4 text-sm">No additional photos</div>
                    @endforelse
                </div>
            </div>

            @if(count($related) > 0)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="font-bold text-lg mb-4">You Might Also Like</h3>
                    
                    <div class="flex flex-col gap-4">
                        
                        @foreach($related as $item)
                            <a href="{{ route('public.destination.show', $item->id) }}" class="flex gap-3 group">
                                <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0 relative">
                                    <img src="{{ asset('storage/' . ($item->thumbnail ?? 'tumpak-sewu.jpg')) }}" 
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" 
                                        alt="{{ $item->name }}">
                                </div>
                                
                                <div class="flex flex-col justify-center">
                                    <h4 class="font-medium text-[#060b0b] group-hover:text-[#47b6c2] transition-colors line-clamp-2 leading-snug">
                                        {{ $item->name }}
                                    </h4>
                                    
                                    <div class="flex items-center gap-1 text-sm text-[#060b0b]/60 mt-1">
                                        <svg class="w-3 h-3 text-yellow-400 fill-current" viewBox="0 0 24 24">
                                            <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                        </svg>
                                        <span class="font-semibold">{{ number_format($item->rating, 1) }}</span>
                                        <span class="text-xs text-gray-400">({{ $item->total_reviews }})</span>
                                    </div>

                                    @if($item->category)
                                        <span class="text-[10px] text-[#47b6c2] mt-1">{{ $item->category->name }}</span>
                                    @endif
                                </div>
                            </a>
                        @endforeach

                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

<style>
    /* Sembunyiin Scrollbar tapi tetep bisa scroll (Chrome/Safari/Webkit) */
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.1);
        border-radius: 20px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background-color: rgba(0, 0, 0, 0.2);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var lat = {{ $wisata->latitude ?? -8.1724 }};
        var lng = {{ $wisata->longitude ?? 113.7007 }};
        var isLocationSet = {{ $wisata->latitude ? 'true' : 'false' }};

        var map = L.map('map-detail').setView([lat, lng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker = L.marker([lat, lng]).addTo(map);

        marker.bindPopup(`
            <div class="text-center p-1">
                <b class="text-[#060b0b] text-sm">{{ $wisata->name }}</b><br>
                <span class="text-xs text-gray-500">{{ $wisata->category->name ?? 'Wisata' }}</span>
            </div>
        `);

        if(isLocationSet) {
            marker.openPopup();
        }
    });
</script>