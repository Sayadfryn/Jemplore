@props([
    'action' => route('public.destinations'),
    'placeholder' => 'Cari...',
    'showFilters' => true
])

<section class="relative -mt-10 z-30">
    <form action="{{ $action }}" method="GET" class="w-full max-w-7xl mx-auto bg-white rounded-2xl p-4 md:p-6 shadow-sm border border-gray-100 mb-10">

        <div class="flex flex-col lg:flex-row items-center gap-4 w-full">

            <div class="relative flex-1 w-full h-[54px] flex items-center bg-white rounded-xl border border-[#98dce4]/50 focus-within:border-[#47b6c2] focus-within:ring-2 focus-within:ring-[#47b6c2]/20 transition-all px-4 gap-3">

                <div class="flex-shrink-0 text-[#47b6c2]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="w-full h-full bg-transparent border-none outline-none focus:ring-0 text-gray-700 text-sm placeholder-gray-400"
                    placeholder="{{ $placeholder }}"
                    autocomplete="off"
                />
            </div>

            <div class="flex flex-wrap md:flex-nowrap items-center gap-3 w-full lg:w-auto justify-end">

                @if($showFilters)
                    <div class="relative group w-full md:w-auto">
                        <select name="category" class="h-[54px] lg:h-11 px-4 pl-4 pr-10 bg-[#f3f3f5] rounded-xl text-xs font-medium text-gray-700 border-none focus:ring-2 focus:ring-[#47b6c2] cursor-pointer appearance-none w-full md:min-w-[140px]">
                            <option value="All">Semua Kategori</option>
                            @if(str_contains($action, 'culinary'))
                                <option value="Traditional" {{ request('category') == 'Traditional' ? 'selected' : '' }}>Traditional</option>
                                <option value="Modern" {{ request('category') == 'Modern' ? 'selected' : '' }}>Modern</option>
                                <option value="Snack" {{ request('category') == 'Snack' ? 'selected' : '' }}>Snack</option>
                                <option value="Beverage" {{ request('category') == 'Beverage' ? 'selected' : '' }}>Beverage</option>
                            @else
                                @foreach(\App\Models\Category::all() as $cat)
                                    <option value="{{ $cat->name }}" {{ request('category') == $cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                @endif

                <button type="submit" class="h-[54px] lg:h-11 px-6 bg-[#47b6c2] hover:bg-[#3da0aa] text-white rounded-xl font-medium shadow-lg shadow-[#47b6c2]/30 transition-all active:scale-95 flex items-center justify-center gap-2 w-full md:w-auto">
                    Cari
                </button>

            </div>
        </div>
    </form>
</section>
