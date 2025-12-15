<x-main>
    <x-navbar isActive='Kulinary'></x-navbar>
    
    <div class="bg-gray-50 border-b border-gray-200 sticky top-20 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <a href="{{ route('public.culinary') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-[#47b6c2] transition font-medium text-sm group">
                <div class="w-8 h-8 rounded-full bg-white border border-gray-200 flex items-center justify-center group-hover:border-[#47b6c2] transition">
                    <svg class="w-4 h-4 transform group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </div>
                Kembali ke Daftar Kuliner
            </a>
        </div>
    </div>

    <div class="container mx-auto px-4 max-w-6xl py-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 mb-2 items-start">
            
            <div class="lg:col-span-5 sticky top-32">
                <div class="relative w-full  md:aspect-square rounded-[2rem] overflow-hidden shadow-2xl border-4 border-white group">
                    <img src="{{ asset('storage/' . ($culinary->image ?? 'foods.png')) }}" 
                         alt="{{ $culinary->name }}" 
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-60"></div>

                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-white/95 backdrop-blur text-[#060b0b] font-bold rounded-full shadow-lg text-xs uppercase tracking-wider flex items-center gap-2">
                        {{ $culinary->primary_tag }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 flex flex-col justify-center py-4">
                
                <h1 class="text-4xl md:text-5xl font-black text-[#060b0b] mb-4 leading-tight tracking-tight">
                    {{ $culinary->name }}
                </h1>

                <div class="flex items-center gap-4 mb-8">
                    <div class="flex items-center gap-1.5 text-yellow-400">
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 24 24"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <span class="text-xl font-bold text-[#060b0b]">{{ number_format($culinary->rating, 1) }}</span>
                    </div>
                    <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                    <span class="text-gray-500 font-medium underline decoration-gray-300 underline-offset-4">{{ $culinary->total_reviews ?? 0 }} Ulasan</span>
                </div>

                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Harga Menu</p>
                            <p class="text-2xl font-bold text-[#47b6c2]">
                                @if($culinary->price_type == 'range')
                                    Rp {{ number_format($culinary->min_price, 0, ',', '.') }} 
                                    <span class="text-gray-400 text-lg font-normal">-</span> 
                                    {{ number_format($culinary->max_price / 1000, 0) }}rb
                                @else
                                    Rp {{ number_format($culinary->price, 0, ',', '.') }}
                                @endif
                            </p>
                        </div>

                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Tersedia di</p>
                            @if($culinary->tourismObject)
                                <a href="{{ route('public.destination.show', $culinary->tourismObject->id) }}" class="flex items-center gap-2 group/link">
                                    <span class="font-bold text-gray-800 group-hover/link:text-[#47b6c2] transition line-clamp-1">
                                        {{ $culinary->tourismObject->name }}
                                    </span>
                                    <i class="fas fa-external-link-alt text-xs text-gray-400 group-hover/link:text-[#47b6c2]"></i>
                                </a>
                            @else
                                <span class="font-bold text-gray-800">Jember Area</span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="prose prose-lg text-gray-600 mb-8 leading-relaxed">
                    <p>{{ $culinary->description ?? 'Nikmati kelezatan cita rasa autentik yang disajikan dengan bahan-bahan pilihan berkualitas.' }}</p>
                </div>

                <div class="flex flex-wrap gap-2">
                    @if($culinary->best_at)
                    <span class="px-4 py-2 rounded-xl bg-blue-50 text-blue-600 text-sm font-semibold border border-blue-100">
                        <i class="far fa-clock mr-1"></i> Cocok: {{ $culinary->best_at }}
                    </span>
                    @endif
                    
                    @if($culinary->secondary_tags)
                        @foreach($culinary->secondary_tags as $tag)
                            <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-600 text-sm font-medium border border-gray-200">
                                #{{ $tag }}
                            </span>
                        @endforeach
                    @endif
                </div>

            </div>
        </div>

        <hr class="border-gray-100 mb-16">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            <div class="lg:col-span-2">
                @if($culinary->tourismObject)
                    <x-destination.reviews-section 
                        :reviews="$reviews" 
                        :culinary="$culinary" 
                    />
                @else
                    <div class="bg-gray-50 p-8 rounded-2xl text-center border border-dashed border-gray-300">
                        <i class="far fa-comment-dots text-4xl text-gray-300 mb-3"></i>
                        <p class="text-gray-500">Review tidak tersedia untuk item ini.</p>
                    </div>
                @endif
            </div>

            <div>
                <h3 class="text-xl font-bold text-[#060b0b] mb-6">Mungkin Kamu Suka</h3>
                <div class="flex flex-col gap-4">
                    @forelse($related as $item)
                        <a href="{{ route('public.culinary.profile', $item->id) }}" class="flex gap-4 items-center group">
                            <div class="w-20 h-20 rounded-2xl overflow-hidden shrink-0 shadow-sm border border-gray-100">
                                <img src="{{ asset('storage/' . ($item->image ?? 'foods.png')) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 group-hover:text-[#47b6c2] transition line-clamp-1">{{ $item->name }}</h4>
                                <p class="text-xs text-gray-500 mb-1">{{ $item->primary_tag }}</p>
                                <p class="text-sm font-bold text-[#47b6c2]">
                                    @if($item->price_type == 'range')
                                        Rp {{ number_format($item->min_price, 0, ',', '.') }}++
                                    @else
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    @endif
                                </p>
                            </div>
                        </a>
                    @empty
                        <div class="text-gray-400 text-sm italic">Tidak ada rekomendasi lainnya.</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    <x-footer></x-footer>
</x-main>