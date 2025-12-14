<x-main>
    <x-navbar isActive='Events'></x-navbar>
    
    <div class="bg-white border-b border-gray-100 sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="{{ route('public.events') }}" 
            class="group flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-50 transition-colors w-fit text-[#060b0b]">
                
                <div class="transform group-hover:-translate-x-1 transition-transform duration-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>

                <span class="text-sm font-medium">
                    Kembali ke Daftar Events
                </span>
                
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-6xl py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-5 sticky top-36">
                
                <div class="relative w-full aspect-[4/5] md:aspect-square rounded-[2rem] overflow-hidden shadow-2xl group border-4 border-white">
                    <img src="{{ asset('storage/' . ($event->image ?? 'carnaval.png')) }}" 
                         alt="{{ $event->title }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-md rounded-2xl p-3 shadow-lg text-center min-w-[70px]">
                        <span class="block text-xs font-bold text-gray-400 uppercase tracking-wider">{{ \Carbon\Carbon::parse($event->start_date)->format('M') }}</span>
                        <span class="block text-3xl font-black text-[#47b6c2]">{{ \Carbon\Carbon::parse($event->start_date)->format('d') }}</span>
                        <span class="block text-xs font-bold text-gray-800">{{ \Carbon\Carbon::parse($event->start_date)->format('Y') }}</span>
                    </div>

                    @php
                        $now = \Carbon\Carbon::now();
                        $startDate = \Carbon\Carbon::parse($event->start_date)->startOfDay();
                        $endDate = $event->end_date ? \Carbon\Carbon::parse($event->end_date)->endOfDay() : $startDate->copy()->endOfDay();
                    @endphp

                    <div class="absolute top-6 right-6">
                        @if($now->lt($startDate))
                            <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Akan Datang</span>
                        @elseif($now->between($startDate, $endDate))
                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg animate-pulse">Sedang Berjalan</span>
                        @else
                            <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">Selesai</span>
                        @endif
                    </div>
                </div>

            </div>

            <div class="lg:col-span-7 flex flex-col justify-center py-2">
                
                <h1 class="text-3xl md:text-5xl font-black text-[#060b0b] mb-6 leading-tight">
                    {{ $event->title }}
                </h1>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                    
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-lg shrink-0">
                            <i class="far fa-clock"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Waktu Pelaksanaan</p>
                            <p class="font-bold text-gray-800">
                                {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                @if($event->end_date && $event->end_date != $event->start_date)
                                    - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                @endif
                            </p>
                            @if($event->start_time)
                                <p class="text-sm text-blue-600 font-medium mt-1">
                                    Mulai jam {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB
                                </p>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1">Lokasi</p>
                            <p class="font-bold text-gray-800 line-clamp-2">
                                {{ $event->location_name ?? ($event->tourismObject->name ?? 'Jember') }}
                            </p>
                            @if($event->location_name)
                                <a href="https://www.google.com/maps/search/?api=1&query={{ $event->tourismObject->latitude }},{{ $event->tourismObject->longitude }}" target="_blank" class="inline-flex items-center gap-1 text-xs text-gray-500 font-medium mt-2 hover:text-red-500 transition">
                                    Buka di Google Maps <i class="fas fa-external-link-alt"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 border-l-4 border-[#47b6c2] pl-3">Tentang Event Ini</h3>
                    <div class="prose prose-gray text-gray-600 leading-relaxed text-justify">
                        <p>{{ $event->description ?? 'Tidak ada deskripsi untuk event ini.' }}</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('public.destination.show', $event->tourismObject->id) }}" class="flex-1 bg-[#47b6c2] hover:bg-[#3da0aa] text-white py-3 rounded-xl font-bold shadow-lg shadow-[#47b6c2]/20 transition active:scale-95 flex items-center justify-center gap-2">
                        Lihat Profil Destinasi
                    </a>
                </div>

            </div>
        </div>

        <hr class="my-16 border-gray-100">

        <div>
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-bold text-[#060b0b]">Event Lainnya</h3>
                <a href="{{ route('public.events') }}" class="text-[#47b6c2] font-medium hover:underline text-sm">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($related as $item)
                    <a href="{{ route('public.event.profile', $item->id) }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <div class="relative h-40 overflow-hidden">
                            <img src="{{ asset('storage/' . ($item->image ?? 'carnaval.png')) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-lg text-xs font-bold text-[#47b6c2]">
                                {{ \Carbon\Carbon::parse($item->start_date)->format('d M') }}
                            </div>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-800 text-lg mb-2 line-clamp-1 group-hover:text-[#47b6c2] transition">{{ $item->title }}</h4>
                            <div class="flex items-center gap-2 text-gray-500 text-sm">
                                <i class="fas fa-map-marker-alt text-red-400"></i>
                                <span class="line-clamp-1">{{ $item->location_name ?? 'Jember' }}</span>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-400">Belum ada event lain yang akan datang.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <x-footer></x-footer>
</x-main>