@props([
    'title' => 'Temukan Destinasi Menarik',
    'subtitle' => 'Menyusuri Keindahan Alam dan Budaya Jember'
])

<section class="w-full py-20 bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] relative overflow-hidden">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-10 pointer-events-none">
        <svg class="absolute -top-24 -left-24 w-96 h-96 text-white" fill="currentColor" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="50" />
        </svg>
        <svg class="absolute -bottom-24 -right-24 w-96 h-96 text-white" fill="currentColor" viewBox="0 0 100 100">
            <circle cx="50" cy="50" r="50" />
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center md:text-left">

        <h1 class="text-4xl md:text-5xl font-bold text-white mb-3 tracking-tight drop-shadow-xl">
            {{ $title }}
        </h1>

        <p class="text-[#f9fcfd] text-lg md:text-xl font-light max-w-2xl leading-relaxed opacity-90">
            {{ $subtitle }}
        </p>

    </div>
</section>
