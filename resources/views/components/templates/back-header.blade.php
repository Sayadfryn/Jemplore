@props([
    'href' => '/destination',
    // 'href' => 'javascript:history.back()',
    'text' => 'Back to Destinations'
])

<div class="w-full bg-white border-b border-[#98dce4]/20 py-4 px-4 md:px-24 sticky top-20 z-40">
    
    <a href="{{ $href }}" 
       class="group flex items-center gap-3 px-2 py-2 rounded-lg hover:bg-gray-50 transition-colors w-fit text-[#060b0b]">
        
        <div class="transform group-hover:-translate-x-1 transition-transform duration-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </div>

        <span class="text-sm font-medium">
            {{ $text }}
        </span>
        
    </a>
</div>