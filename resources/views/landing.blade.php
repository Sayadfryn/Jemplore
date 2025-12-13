<x-main>
    <x-navbar></x-navbar>
    @if(session('success'))
        <div id="flash-message" class="fixed top-24 right-5 z-[100] bg-white border-l-4 border-[#47b6c2] shadow-2xl rounded-lg p-4 max-w-sm animate-fade-in-down flex items-start gap-3">
            <div class="text-[#47b6c2]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h4 class="font-bold text-gray-800 text-sm">Berhasil!</h4>
                <p class="text-sm text-gray-600 mt-1">{{ session('success') }}</p>
            </div>
            <button onclick="document.getElementById('flash-message').remove()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <script>
            setTimeout(() => {
                const flash = document.getElementById('flash-message');
                if(flash) {
                    flash.style.opacity = '0';
                    flash.style.transform = 'translateY(-20px)';
                    flash.style.transition = 'all 0.5s ease';
                    setTimeout(() => flash.remove(), 500);
                }
            }, 5000);
        </script>
    @endif
    <x-landing.hero-section></x-landing.hero-section>
    <x-landing.category-section></x-landing.category-section>
    <x-landing.featured-destinations :destinations="$destinations"></x-landing.featured-destinations>
    <x-landing.why-visit-section></x-landing.why-visit-section>
    <x-landing.upcoming-events :events="$events"></x-landing.upcoming-events>
    <x-footer></x-footer>
</x-main>