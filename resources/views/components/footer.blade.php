<footer class="bg-[#060b0b] pt-16 pb-8 border-t border-[#98dce4]/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <div class="flex flex-col gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-[10px] bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center shadow-lg">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19.9901 9.99506C19.9901 14.9856 14.4538 20.183 12.5947 21.7882C12.4215 21.9184 12.2107 21.9889 11.994 21.9889C11.7773 21.9889 11.5665 21.9184 11.3933 21.7882C9.53424 20.183 3.99799 14.9856 3.99799 9.99506C3.99799 7.87438 4.84042 5.84055 6.33997 4.34101C7.83952 2.84146 9.87334 1.99902 11.994 1.99902C14.1147 1.99902 16.1485 2.84146 17.6481 4.34101C19.1476 5.84055 19.9901 7.87438 19.9901 9.99506Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M11.9941 12.9936C13.6501 12.9936 14.9926 11.6511 14.9926 9.99509C14.9926 8.33906 13.6501 6.99658 11.9941 6.99658C10.338 6.99658 8.99554 8.33906 8.99554 9.99509C8.99554 11.6511 10.338 12.9936 11.9941 12.9936Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white text-base font-bold leading-tight">Jemplore</span>
                        <span class="text-[#98dce4] text-xs font-normal">Jember Explore</span>
                    </div>
                </div>

                <p class="text-[#f9fcfd]/70 text-sm leading-relaxed">
                    Discover the hidden beauty of Jember, Indonesia. From beaches to mountains, we have it all.
                </p>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-6">Explore</h3>
                <ul class="flex flex-col gap-4">
                    @foreach(['Destinasi', 'Kuliner', 'Events', 'Paket Wisata'] as $item)
                        <li>
                            <a href="#" class="text-[#f9fcfd]/70 text-sm hover:text-[#47b6c2] transition-colors duration-300">
                                {{ $item }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-6">Support</h3>
                <ul class="flex flex-col gap-4">
                    @foreach(['Contact Us', 'FAQ', 'Travel Guide', 'Terms of Service'] as $item)
                        <li>
                            <a href="#" class="text-[#f9fcfd]/70 text-sm hover:text-[#47b6c2] transition-colors duration-300">
                                {{ $item }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-6">Contact</h3>
                <ul class="flex flex-col gap-4">
                    <li class="flex items-start gap-3 text-[#f9fcfd]/70 text-sm">
                        <svg class="w-5 h-5 text-[#47b6c2] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>info@jemplore.id</span>
                    </li>
                    <li class="flex items-start gap-3 text-[#f9fcfd]/70 text-sm">
                        <svg class="w-5 h-5 text-[#47b6c2] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>+62 123 4567 890</span>
                    </li>
                    <li class="flex items-start gap-3 text-[#f9fcfd]/70 text-sm">
                        <svg class="w-5 h-5 text-[#47b6c2] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Jember, East Java, Indonesia</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-[#f9fcfd]/10 pt-8 text-center">
            <p class="text-[#f9fcfd]/50 text-sm">
                &copy; {{ date('Y') }} Jemplore. All rights reserved. Made in Jember.
            </p>
        </div>

    </div>
</footer>
