@extends('layouts.admin_layout')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-light text-gray-800 border-b pb-4">Semua Ulasan & Rating</h2>
            <p class="text-gray-600 mt-2">Kelola dan pantau semua ulasan pengguna</p>
        </div>
        <a href="{{ url()->previous() }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            Kembali
        </a>

    </div>

  <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 mb-8">
        <form action="{{ route('admin.reviews.all') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Destinasi Wisata</label>
                <select name="tourism_object_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                    <option value="">Seluruh Destinasi Wisata</option>
                    @foreach(\App\Models\TourismObject::all() as $tourism)
                        <option value="{{ $tourism->id }}" {{ request('tourism_object_id') == $tourism->id ? 'selected' : '' }}>
                            {{ $tourism->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Filter Rating</label>
                <select name="rating" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500">
                    <option value="">Seluruh Rating</option>
                    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>Bintang 5</option>
                    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>Bintang 4</option>
                    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>Bintang 3</option>
                    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>Bintang 2</option>
                    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>Bintang 1</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600">
                    Terapkan Filter
                </button>
                <a href="{{ route('admin.reviews.all') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <div class="space-y-4">
        @forelse($reviews as $review)
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 hover:shadow-xl transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3">
                        @if($review->user->avatar)
                            <img src="{{ $review->user->avatar }}" alt="" class="w-12 h-12 rounded-full object-cover">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="font-semibold text-gray-900">{{ $review->user->name }}</h4>
                            <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-1">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        @endfor
                        <span class="ml-2 text-sm font-bold text-gray-700">{{ $review->rating }}/5</span>
                    </div>
                </div>

                @if($review->culinary)
                    <div class="mb-3 inline-flex items-center px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium border border-yellow-200">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Kuliner: {{ $review->culinary->name }}
                        <span class="text-gray-400 mx-1">•</span>
                        <span class="text-xs text-gray-500">{{ $review->culinary->tourismObject->name ?? '-' }}</span>
                    </div>
                @elseif($review->tourismObject)
                    <div class="mb-3 inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium border border-blue-200">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Wisata: {{ $review->tourismObject->name }}
                    </div>
                @endif

                <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>


            </div>
        @empty
            <div class="bg-white p-10 rounded-xl shadow-lg border border-gray-100 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
                <p class="text-gray-500">No reviews found.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $reviews->links() }}
    </div>

@endsection
