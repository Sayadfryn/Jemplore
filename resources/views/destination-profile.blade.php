@props(['wisata', 'reviews' => [], 'events' => [], 'relatedDestinasi' => []])
<x-main>
    <x-navbar isActive='Destinasi'></x-navbar>
    <x-templates.back-header>
    </x-templates.back-header>
    <x-destination.profile
    :wisata="$wisata"
    :reviews="$reviews"
    :events="$events"
    :related="$relatedDestinasi" ></x-destination.profile>
    <x-footer></x-footer>
</x-main>
