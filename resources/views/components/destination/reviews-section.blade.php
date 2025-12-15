@props(['reviews', 'wisata' => null, 'culinary' => null])
@php
    if ($wisata) {
        $review = $wisata;
    } elseif ($culinary) {
        $review = $culinary;
    }
@endphp

<div class="flex flex-col w-full gap-8 bg-white mt-12" id="reviews-section">

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 border-b border-gray-100 pb-6">
        <div>
            <h3 class="text-xl font-bold text-[#060b0b]">Reviews & Feedback</h3>
            <p class="text-sm text-gray-500 mt-1">Total {{ $review->total_reviews}} reviews</p>
        </div>

        <form method="GET" class="flex gap-3 w-full md:w-auto">
            <select name="rating" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 focus:outline-none focus:border-[#47b6c2] cursor-pointer bg-white">
                <option value="all" {{ request('rating') == 'all' ? 'selected' : '' }}>Seluruh Rating</option>
                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (5)</option>
                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐ (4)</option>
                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐ (3)</option>
                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐⭐ (2)</option>
                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐ (1)</option>
            </select>
            <select name="sort" onchange="this.form.submit()" class="px-4 py-2 border border-gray-200 rounded-lg text-sm text-gray-600 focus:outline-none focus:border-[#47b6c2] cursor-pointer bg-white">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                <option value="highest" {{ request('sort') == 'highest' ? 'selected' : '' }}>Highest Rating</option>
                <option value="lowest" {{ request('sort') == 'lowest' ? 'selected' : '' }}>Lowest Rating</option>
            </select>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 text-sm border border-green-100 flex items-center gap-2">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 text-red-700 p-4 rounded-lg mb-4 text-sm border border-red-100 flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    @guest
        <div class="bg-gray-50 border border-dashed border-gray-300 rounded-xl p-8 text-center">
            <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-3">
                <i class="fas fa-lock text-gray-400"></i>
            </div>
            <h4 class="text-gray-900 font-semibold mb-1">Ingin memberikan ulasan?</h4>
            <p class="text-gray-500 text-sm mb-4">Silakan login terlebih dahulu untuk berbagi pengalamanmu.</p>
            <a href="{{ route('login') }}" class="inline-flex items-center px-6 py-2.5 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-lg font-medium transition text-sm">
                Login Sekarang
            </a>
        </div>
    @else
        @php
            if ($culinary) {
                $myReview = \App\Models\Review::where('user_id', auth()->id())
                        ->where('culinary_id', $review->id)
                        ->first();
            } else {
                $myReview = \App\Models\Review::where('user_id', auth()->id())
                            ->where('tourism_object_id', $review->id)
                            ->first();
            }
        @endphp

        @if($myReview)
            <div class="bg-white border-2 border-[#47b6c2]/20 rounded-2xl p-6 shadow-sm relative overflow-hidden mb-8">
                <div class="absolute top-0 right-0 bg-[#47b6c2] text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl shadow-sm">
                    ULASAN KAMU
                </div>

                <div class="flex gap-4">
                    <div class="shrink-0 w-12 h-12 bg-[#47b6c2] rounded-full flex items-center justify-center text-white text-lg font-bold uppercase ring-4 ring-[#47b6c2]/10">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                            <h3 class="text-[#060b0b] text-base font-bold">{{ auth()->user()->name }}</h3>
                            <span class="text-[#060b0b]/60 text-sm">{{ $myReview->created_at->diffForHumans() }}</span>
                        </div>

                        <div class="flex gap-1">
                            @for($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 {{ $i < $myReview->rating ? 'text-yellow-400 fill-current' : 'text-gray-200' }}" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            @endfor
                        </div>

                        <p class="text-[#060b0b]/80 text-sm leading-relaxed mt-1">
                            {{ $myReview->comment }}
                        </p>

                        <div class="flex items-center justify-end gap-2 mt-3 pt-3 border-t border-dashed border-gray-200">
                            <button onclick="openEditModal({{ $myReview->id }}, {{ $myReview->rating }}, '{{ $myReview->comment }}')"
                                    class="group flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-all duration-200 active:scale-95">
                                <i class="fas fa-pen text-[10px] group-hover:rotate-12 transition-transform"></i>
                                <span>Edit</span>
                            </button>

                            <form action="{{ route('review.delete', $myReview->id) }}" method="POST" onsubmit="return confirm('Yakin mau menghapus ulasan ini?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="group flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-all duration-200 active:scale-95">
                                    <i class="fas fa-trash-alt text-[10px] group-hover:scale-110 transition-transform"></i>
                                    <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <form action="{{ route('review.store') }}" method="POST" class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm mb-8 transition-all hover:shadow-md">
                @csrf

                @if($culinary)
                    <input type="hidden" name="culinary_id" value="{{ $review->id }}">
                @elseif($wisata)
                    <input type="hidden" name="tourism_object_id" value="{{ $review->id }}">
                @endif

                <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <i class="far fa-edit text-[#47b6c2]"></i> Tulis Pengalamanmu
                </h4>

                <div class="flex items-center gap-1 mb-4 flex-row-reverse justify-end group/stars">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="peer hidden" required />
                        <label for="star{{ $i }}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 transition-colors">
                            <svg class="w-8 h-8 fill-current" viewBox="0 0 24 24"><path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/></svg>
                        </label>
                    @endfor
                </div>

                <div class="mb-4">
                    <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-[#47b6c2] focus:border-transparent outline-none text-sm transition-all" placeholder="Ceritakan detail pengalaman serumu di sini..." required></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-lg font-medium text-sm transition shadow-lg shadow-[#47b6c2]/20 active:scale-95">
                        Kirim Ulasan
                    </button>
                </div>
            </form>
        @endif
    @endguest

    <section class="flex flex-col gap-4 w-full">
        @forelse($reviews as $review)
            @auth
                @if($review['user_id'] == auth()->id())
                    @continue
                @endif
            @endauth

            <article class="flex gap-4 p-6 bg-white rounded-2xl shadow-sm border border-gray-100 transition-shadow hover:shadow-md">

                <div class="shrink-0 w-12 h-12 bg-[#47b6c2] rounded-full flex items-center justify-center text-white text-lg font-bold uppercase">
                    {{ $review['initial'] }}
                </div>

                <div class="flex flex-col gap-2 w-full">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <h3 class="text-[#060b0b] text-base font-bold">{{ $review['name'] }}</h3>
                        <span class="text-[#060b0b]/60 text-sm">{{ $review['timeAgo'] }}</span>
                    </div>

                    <div class="flex gap-1">
                        @for($i = 0; $i < 5; $i++)
                            <svg class="w-4 h-4 {{ $i < $review['rating'] ? 'text-yellow-400 fill-current' : 'text-gray-200' }}" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        @endfor
                    </div>

                    <p class="text-[#060b0b]/80 text-sm leading-relaxed mt-1">
                        {{ $review['comment'] }}
                    </p>
                </div>
            </article>
        @empty
            @guest
            <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                <p class="text-gray-500 text-sm">Belum ada ulasan lain.</p>
            </div>
            @else
                @if(!$myReview)
                    <div class="text-center py-12 bg-gray-50 rounded-2xl border border-dashed border-gray-300">
                        <p class="text-gray-500 text-sm">Belum ada ulasan lain. Jadilah yang pertama!</p>
                    </div>
                @endif
            @endguest
        @endforelse

        <div class="mt-6 flex justify-center">
            {{ $reviews->links() }}
        </div>
    </section>

    <div id="editReviewModal" class="fixed inset-0 z-[100] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl w-full max-w-lg p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-gray-900 mb-4">Edit Ulasan Anda</h3>

            <form id="editReviewForm" method="POST">
                @csrf
                @method('PUT')

                <div class="flex items-center gap-1 mb-4 flex-row-reverse justify-end">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" id="editstar{{ $i }}" name="rating" value="{{ $i }}" class="peer hidden" />
                        <label for="editstar{{ $i }}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400 hover:text-yellow-400 peer-hover:text-yellow-400 text-2xl transition-colors">★</label>
                    @endfor
                </div>

                <textarea name="comment" id="editComment" rows="3" class="w-full border border-gray-300 rounded-xl p-4 focus:ring-2 focus:ring-[#47b6c2] focus:border-transparent outline-none text-sm mb-4" required></textarea>

                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-lg text-sm font-medium">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-lg font-medium text-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function openEditModal(id, rating, comment) {
        const form = document.getElementById('editReviewForm');
        form.action = `/review/${id}`;
        document.getElementById(`editstar${rating}`).checked = true;
        document.getElementById('editComment').value = comment;
        document.getElementById('editReviewModal').classList.remove('hidden');
    }

    function closeEditModal() {
        document.getElementById('editReviewModal').classList.add('hidden');
    }
</script>
