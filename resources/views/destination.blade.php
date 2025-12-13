<x-main>
    <x-navbar isActive='Destinations'></x-navbar>
    <x-templates.page-header></x-templates.page-header>
    <x-destination.search-bar></x-destination.search-bar>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <div class="mb-6 text-[#060b0b]/60 font-medium">
            Showing <span class="text-[#060b0b] font-bold">{{ count($destinations) }}</span> destinations
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <x-templates.card-md :data="$destinations" ></x-templates.card-md>
        </div>
        
        <div class="mt-12 flex justify-center">
            {{ $destinations->links() }}
        </div>
    </div>
    <x-footer></x-footer>
</x-main>