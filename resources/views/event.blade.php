<x-main>
    <x-navbar isActive='Events'></x-navbar>
    
    <x-templates.page-header>
        @slot('title')
            Upcoming Events in Jember
        @endslot
        @slot('subtitle')
            Don't miss out on the excitement! Discover festivals, workshops, and more.
        @endslot
    </x-templates.page-header>

    <x-destination.search-bar 
        action="{{ route('public.events') }}" 
        placeholder="Cari event seru..."
        :showFilters="false"
    />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="mb-6 text-[#060b0b]/60 font-medium">
            Showing <span class="text-[#060b0b] font-bold">{{ $events->count() }}</span> of <span class="text-[#060b0b] font-bold">{{ $events->total() }}</span> Upcoming Events
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