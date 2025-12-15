@props(['events' => []])

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#060b0b] mb-2">
                Upcoming Events
            </h2>
            <p class="text-[#060b0b]/60 text-base">
                Don't miss these exciting events in Jember
            </p>
        </div>

        <a href="{{ route('public.events') }}" class="group flex items-center gap-2 px-5 py-2.5 rounded-xl border border-[#47b6c2]/30 hover:bg-[#47b6c2]/5 transition text-[#47b6c2] font-medium">
            View More Events
            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
            </svg>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        @foreach($events as $event)
            <article class="flex flex-col sm:flex-row bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group h-full sm:h-[200px]">
                
                <div class="w-full sm:w-48 h-48 sm:h-full relative overflow-hidden shrink-0">
                    <img src="{{ asset('storage/' . $event['image']) }}" 
                         alt="{{ $event['title'] }}" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                    
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                </div>

                <div class="p-6 flex flex-col justify-center flex-1">
                    
                    <div class="inline-flex items-center px-3 py-1 bg-[#5dd2de]/20 rounded-lg w-fit mb-3">
                        <svg class="w-3 h-3 text-[#060b0b] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-[#060b0b] text-xs font-bold uppercase tracking-wider">
                            {{ $event['date'] }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-[#060b0b] mb-2 group-hover:text-[#47b6c2] transition-colors">
                        {{ $event['title'] }}
                    </h3>

                    <p class="text-[#060b0b]/60 text-sm leading-relaxed line-clamp-2">
                        {{ $event['description'] }}
                    </p>

                </div>
            </article>
        @endforeach

    </div>

</section>