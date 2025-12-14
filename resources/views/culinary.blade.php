<x-main>
    <x-navbar isActive='Culinary'></x-navbar>

    <x-templates.page-header>
        @slot('title')
            Nikmati Ragam Kuliner
        @endslot
        @slot('subtitle')
            Rasakan Cita Rasa Asli Jember.
        @endslot
    </x-templates.page-header>

    <x-destination.search-bar
        action="{{ route('public.culinary') }}"
        placeholder="Cari makanan, minuman, atau snack..."
    />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="mb-6 text-[#060b0b]/60 font-medium">
            Menampilkan <span class="text-[#060b0b] font-bold">{{ $culinaries->count() }}</span> dari <span class="text-[#060b0b] font-bold">{{ $culinaries->total() }}</span> kuliner
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <x-templates.card-md :data="$culinaries->items()" />
        </div>

        <div class="mt-12 flex justify-center">
            {{ $culinaries->links() }}
        </div>
    </div>
    <x-footer></x-footer>
</x-main>
