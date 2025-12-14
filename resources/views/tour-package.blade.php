<x-main>
    <x-navbar isActive='Paket Wisata'></x-navbar>

    <x-templates.page-header>
        @slot('title')
            Paket Wisata
        @endslot
        @slot('subtitle')
            Pengalaman Terpilih untuk Petualangan Sempurna di Jember
        @endslot
    </x-templates.page-header>

    {{-- <x-destination.search-bar action="{{ route('public.packages') }}" placeholder="Search packages..."></x-destination.search-bar> --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16 pt-8">

        <div class="mb-6 text-[#060b0b]/60 font-medium">
            Menampilkan <span class="text-[#060b0b] font-bold">{{ $packages->count() }}</span> dari <span class="text-[#060b0b] font-bold">{{ $packages->total() }}</span> paket
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <x-templates.card-xl :data="$packages->items()" />
        </div>

        <div class="mt-12 flex justify-center">
            {{ $packages->links() }}
        </div>
    </div>
    <x-footer></x-footer>
</x-main>
