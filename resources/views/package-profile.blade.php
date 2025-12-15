<x-main>
    <x-navbar isActive='Paket Wisata'></x-navbar>
    
    <div class="bg-white border-b border-gray-100 sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="{{ route('public.packages') }}" 
               class="group flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-50 transition-colors w-fit text-[#060b0b]">
                <div class="transform group-hover:-translate-x-1 transition-transform duration-200">
                    <i class="fas fa-arrow-left text-[#47b6c2]"></i>
                </div>
                <span class="text-sm font-medium">Kembali ke Daftar Paket</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-6xl py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            
            <div class="lg:col-span-5 sticky top-36">
                <div class="relative w-full aspect-[4/5] md:aspect-square rounded-[2rem] overflow-hidden shadow-2xl group border-4 border-white">
                    <img src="{{ asset('storage/' . ($package->thumbnail ?? 'hero-bg.png')) }}" 
                         alt="{{ $package->name }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    @if($package->tourismObject)
                        <div class="absolute bottom-6 left-6 right-6">
                            <div class="bg-white/95 backdrop-blur-md p-4 rounded-xl shadow-lg border border-white/50">
                                <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Diselenggarakan oleh</p>
                                <a href="{{ route('public.destination.show', $package->tourismObject->id) }}" class="flex items-center gap-2 group/link">
                                    <span class="font-bold text-gray-900 text-lg line-clamp-1 group-hover/link:text-[#47b6c2] transition">
                                        {{ $package->tourismObject->name }}
                                    </span>
                                    <i class="fas fa-external-link-alt text-xs text-gray-400"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col justify-center py-2">
                
                <h1 class="text-3xl md:text-5xl font-black text-[#060b0b] mb-4 leading-tight">
                    {{ $package->name }}
                </h1>

                <div class="flex items-baseline gap-2 mb-8">
                    <span class="text-3xl font-bold text-[#47b6c2]">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 text-sm">/ pax (estimasi)</span>
                </div>

                <div class="prose prose-gray text-gray-600 leading-relaxed mb-8">
                    <p>{{ $package->description }}</p>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-check-circle text-[#47b6c2]"></i> Fasilitas Paket
                    </h3>
                    
                    @if(is_array($package->features) && count($package->features) > 0)
                        <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($package->features as $feature)
                                <li class="flex items-start gap-3">
                                    <div class="w-5 h-5 rounded-full bg-[#47b6c2]/10 flex items-center justify-center shrink-0 mt-0.5">
                                        <i class="fas fa-check text-[10px] text-[#47b6c2]"></i>
                                    </div>
                                    <span class="text-sm text-gray-600">{{ $feature }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400 italic text-sm">Tidak ada detail fasilitas.</p>
                    @endif
                </div>

                <div class="flex gap-3">
                    @if($package->tourismObject && $package->tourismObject->contact_number)
                        @php
                            $waNumber = $package->tourismObject->contact_number;
                            if(substr($waNumber, 0, 1) == '0') {
                                $waNumber = '62' . substr($waNumber, 1);
                            }
                            
                            $message = "Halo admin " . $package->tourismObject->name . ", saya tertarik untuk memesan paket wisata: *" . $package->name . "* seharga Rp " . number_format($package->price, 0, ',', '.') . ". Mohon info ketersediaannya.";
                        @endphp

                        <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($message) }}" 
                           target="_blank"
                           class="flex-1 bg-[#47b6c2] hover:bg-[#3da0aa] text-white py-3.5 rounded-xl font-bold shadow-lg shadow-[#47b6c2]/20 transition active:scale-95 flex items-center justify-center gap-2">
                            <i class="fab fa-whatsapp text-xl"></i> Pesan Sekarang
                        </a>
                    @else
                        <button disabled class="flex-1 bg-gray-300 text-white py-3.5 rounded-xl font-bold cursor-not-allowed flex items-center justify-center gap-2">
                            <i class="fas fa-ban"></i> Pemesanan Tutup
                        </button>
                    @endif
                </div>
                
                <p class="text-xs text-gray-400 mt-4 text-center">
                    *Anda akan diarahkan ke WhatsApp kontak resmi destinasi.
                </p>

            </div>
        </div>

        <hr class="my-16 border-gray-100">

        <div>
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-bold text-[#060b0b]">Paket Lainnya</h3>
                <a href="{{ route('public.packages') }}" class="text-[#47b6c2] font-medium hover:underline text-sm">Lihat Semua</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($related as $item)
                    <a href="{{ route('public.package.profile', $item->id) }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full">
                        <div class="relative h-48 overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . ($item->thumbnail ?? 'hero-bg.png')) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div class="absolute bottom-3 right-3 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-xs font-bold text-[#060b0b] shadow-sm">
                                Rp {{ number_format($item->price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-1">
                            <h4 class="font-bold text-gray-800 text-lg mb-2 line-clamp-1 group-hover:text-[#47b6c2] transition">{{ $item->name }}</h4>
                            <p class="text-sm text-gray-500 line-clamp-2 mb-4 flex-1">{{ $item->description }}</p>
                            
                            <div class="flex flex-wrap gap-2">
                                @if(is_array($item->features))
                                    @foreach(array_slice($item->features, 0, 2) as $feat)
                                        <span class="bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded">{{ $feat }}</span>
                                    @endforeach
                                    @if(count($item->features) > 2)
                                        <span class="text-[10px] text-gray-400">+{{ count($item->features) - 2 }} lainnya</span>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-3 text-center py-10 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-400">Belum ada paket wisata lainnya.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <x-footer></x-footer>
</x-main>