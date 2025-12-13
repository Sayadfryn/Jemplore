@props(['wisata', 'reviews' => [], 'events' => [], 'relatedDestinations' => []])
<x-main>
    <x-navbar isActive='Destinations'></x-navbar>
    <x-templates.back-header> 
    </x-templates.back-header>
    <x-destination.profile 
    :wisata="$wisata" 
    :reviews="$reviews" 
    :events="$events" 
    :related="$relatedDestinations" ></x-destination.profile>
    <x-footer></x-footer>
</x-main>