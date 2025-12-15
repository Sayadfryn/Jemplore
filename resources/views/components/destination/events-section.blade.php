@props(['events' => []])

<div class="flex flex-col w-full gap-8 bg-white mt-12" id="events-section">

    <section class="flex flex-col gap-4 w-full">
        
        @php
            if(empty($events)) {
                $events = [
                    [
                        'id' => 1,
                        'title' => 'Sunrise Trek',
                        'date' => 'November 20, 2025',
                        'image' => 'tumpak-sewu.png',
                    ],
                    [
                        'id' => 2,
                        'title' => 'Photography Workshop',
                        'date' => 'December 5, 2025',
                        'image' => 'carnaval.png',
                    ],
                ];
            }
        @endphp

        @foreach($events as $event)
            <article class="group flex flex-col sm:flex-row items-center gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100 transition-all hover:shadow-md hover:-translate-y-1 duration-300">
                
                <div class="w-full sm:w-24 h-48 sm:h-24 shrink-0 rounded-xl overflow-hidden">
                    <img src="{{ asset('storage/' . $event['image']) }}" 
                         alt="{{ $event['title'] }}" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                </div>

                <div class="flex flex-col gap-1 flex-1 w-full text-left">
                    <h3 class="text-[#060b0b] text-lg font-bold group-hover:text-[#47b6c2] transition-colors">
                        {{ $event['title'] }}
                    </h3>
                    <div class="flex items-center gap-2 text-[#060b0b]/60 text-sm">
                        <svg class="w-4 h-4 text-[#47b6c2]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <time>{{ $event['date'] }}</time>
                    </div>
                </div>

                <button class="w-full sm:w-auto px-6 py-2 bg-[#47b6c2] text-white rounded-xl hover:bg-[#3da0aa] transition-all shadow-md shadow-[#47b6c2]/20 text-sm font-medium whitespace-nowrap active:scale-95">
                    Learn More
                </button>

            </article>
        @endforeach

    </section>
</div>