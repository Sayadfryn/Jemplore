<x-main>
    <x-navbar isActive='Events'></x-navbar>

    <x-templates.page-header>
        @slot('title')
            Event Mendatang di Jember
        @endslot
        @slot('subtitle')
            Keseruan menanti! Temukan festival, workshop, dan acara seru lainnya.
        @endslot
    </x-templates.page-header>

    <x-destination.search-bar
        action="{{ route('public.events') }}"
        placeholder="Cari event seru..."
        :showFilters="false"
    />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="mb-6 text-[#060b0b]/60 font-medium">
            Menampilkan <span class="text-[#060b0b] font-bold">{{ $events->count() }}</span> dari <span class="text-[#060b0b] font-bold">{{ $events->total() }}</span> event yang akan datang
        </div>

        <div class="flex flex-col gap-8">
            <x-templates.card-row :data="$events->items()" />
        </div>

        <div class="mt-12 flex justify-center">
            {{ $events->links() }}
        </div>
    </div>
    <x-footer></x-footer>
</x-main>
