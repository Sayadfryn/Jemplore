<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jemplore - Jember Explore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#47B6C2',
                        'primary-dark': '#5DD2DE',
                        'primary-light': '#98DCE4',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-text-blur {
            filter: blur(0.3px);
        }
        
        .hero-subtitle {
            text-shadow: 
                0 0 10px rgba(255, 255, 255, 0.8),
                0 0 20px rgba(255, 255, 255, 0.6),
                0 0 30px rgba(255, 255, 255, 0.4),
                2px 2px 8px rgba(0,0,0,0.5);
        }
        
        .hero-title {
            text-shadow: 
                4px 4px 10px rgba(0,0,0,0.8),
                0 0 20px rgba(255,255,255,0.3);
            filter: blur(0.5px);
        }
        
        .navbar-hover-area {
            position: relative;
        }
        
        .navbar-hover-area::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            right: 0;
            height: 120px;
            z-index: 40;
        }
    </style>
</head>
<body class="bg-white">
    <body class="bg-white">
    
    <div class="fixed top-0 right-0 z-[999] p-4">
        <a href="{{ route('admin.dashboard') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-lg text-white bg-red-600 hover:bg-red-700 transition duration-150 transform hover:scale-105"
           title="Akses Langsung ke Dashboard Admin (Mode Testing)">
            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.103A.996.996 0 0017 3H7a1 1 0 00-7-7v14a2 2 0 002 2h14a2 2 0 002-2V7a1 1 0 00-.382-.782z"></path></svg>
            ADMIN TEST MODE
        </a>
    </div>

    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-500 navbar-hover-area">

    <nav id="navbar" class="fixed top-0 w-full z-50 transition-all duration-500 navbar-hover-area">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <img src="{{ asset('storage/LogoAtas.png') }}" alt="Jemplore Logo" class="h-12 drop-shadow-lg">
                </div>
                
                <ul class="hidden md:flex space-x-8 font-medium">
                    <li><a href="#jelajahi" class="text-white hover:text-primary-light transition drop-shadow-lg">Jelajahi</a></li>
                    <li><a href="#menu2" class="text-white hover:text-primary-light transition drop-shadow-lg">Menu 2</a></li>
                    <li><a href="#menu3" class="text-white hover:text-primary-light transition drop-shadow-lg">Menu 3</a></li>
                </ul>
                
                <div class="flex items-center space-x-2 cursor-pointer hover:opacity-80 transition">
                    <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-5 h-5 text-white drop-shadow-lg" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-white font-medium drop-shadow-lg">Login</span>
                </div>
            </div>
        </div>  
    </nav>

    <section class="relative h-screen bg-cover bg-center flex items-center justify-center" style="background-image: linear-gradient(rgba(6, 11, 11, 0.25), rgba(6, 11, 11, 0.25)), url('{{ asset('images/jember.png') }}');">
        <div class="text-center text-white px-4">
            <p class="hero-subtitle text-primary-light text-2xl md:text-3xl mb-6 font-light tracking-widest uppercase">
                Selamat Datang Di Kota Karnaval
            </p>
            <h1 class="hero-title text-8xl md:text-[12rem] font-black tracking-widest mb-6 leading-none">
                Jember
            </h1>
            <p class="hero-subtitle text-primary-light text-2xl md:text-3xl font-light tracking-widest uppercase">
                Dengan Beribu Keindahannya
            </p>
        </div>
        
        <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-b from-transparent via-black/10 to-black/20"></div>
    </section>

    <section class="relative bg-gradient-to-br from-primary to-primary-dark min-h-screen flex items-center">
        <div class="absolute top-0 left-0 right-0 h-60 bg-cover bg-center opacity-30" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-position: bottom;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                <div class="text-white">
                    <h2 class="text-5xl md:text-6xl font-bold italic mb-6">Jemplore</h2>
                    <p class="text-base leading-relaxed mb-6 text-justify">
                        Jemplore Merupakan Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dignissim, arcu sed suscipit gravida, mauris lorem fermentum massa, at placerat orci nibh id neque. Nulla vestibulum nuam ac elit viverra, ut gravida leo faucibus. Suspendisse elementum sem sit amet neque suscipit, vitae laoreet erat cursus. Sed blandit mi ut risus ornare, vitae vehicula nunc ullamcorper. Integer sit amet ante a urna pellentesque dignissim.
                    </p>
                    <p class="font-semibold text-lg mb-6">Masuk Untuk Pengalaman yang lebih Memukau</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-white text-primary px-10 py-3 rounded-full font-semibold hover:shadow-lg hover:-translate-y-1 transition transform">
                            Sign in
                        </button>
                        <button class="bg-gray-800 text-white px-10 py-3 rounded-full font-semibold hover:bg-gray-900 hover:-translate-y-1 transition transform">
                            Login
                        </button>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div>
                    <img src="{{ asset('images/View.png') }}" alt="View" class="rounded-2xl shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="min-h-screen flex items-center bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">
                    Acara Yang Tidak Boleh Terlewatkan
                </h2>
                <button class="bg-white border-2 border-primary text-primary px-6 py-2 rounded-full font-semibold hover:bg-primary hover:text-white transition">
                    Jelajahi Acara →
                </button>
            </div>
            
            <!-- Carousel Container -->
            <div class="relative">
                <!-- Carousel Wrapper -->
                <div class="overflow-hidden">
                    <div id="eventCarousel" class="flex gap-8 transition-transform duration-500 ease-out">
                        <!-- Card 1 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event1.jpg') }}" alt="Papuma Recruitment" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Papuma Recruitment</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>12 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Yogyakarta</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event2.jpg') }}" alt="Bornoday Land" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Bornoday Land</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>15 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Jakarta</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 3 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event3.jpg') }}" alt="Auten Soi" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Auten Soi</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>20 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Bandung</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 4 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event1.jpg') }}" alt="Festival Budaya" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Festival Budaya</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>25 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Surabaya</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 5 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event2.jpg') }}" alt="Music Fest" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Music Fest</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>28 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Bali</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Card 6 -->
                        <div class="flex-shrink-0 w-full md:w-[calc(33.333%-1.5rem)] bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                            <img src="{{ asset('images/event3.jpg') }}" alt="Food Festival" class="w-full h-64 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-3">Food Festival</h3>
                                <div class="flex items-center text-gray-600 text-sm mb-2">
                                    <span class="mr-2">📅</span>
                                    <span>31 Des 2025</span>
                                </div>
                                <div class="flex items-center text-gray-600 text-sm">
                                    <span class="mr-2">📍</span>
                                    <span>Malang</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation Buttons -->
                <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-primary hover:text-white transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                </button>
                <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-primary hover:text-white transition z-10">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
                
                <!-- Dots Indicator -->
                <div id="dotsContainer" class="flex justify-center gap-2 mt-8">
                    <!-- Dots will be generated by JavaScript -->
                </div>
            </div>
        </div>
    </section>

    <!-- Footer dengan background extension -->
    <footer class="relative bg-gradient-to-br from-primary to-primary-dark text-white py-12">
        <!-- Background image extension -->
        <div class="absolute top-0 left-0 right-0 h-40 bg-cover bg-center opacity-20" style="background-image: url('{{ asset('images/hero-bg.jpg') }}'); background-position: top;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Logo -->
                <div>
                    <img src="{{ asset('images/LogoBawah.png') }}" alt="Jemplore" class="h-16 mb-4">
                </div>
                
                <!-- Links Column 1 -->
                <div>
                    <div class="space-y-3">
                        <a href="#" class="block hover:opacity-80 transition">Tentang Kami</a>
                        <a href="#" class="block hover:opacity-80 transition">Kebijakan Privasi</a>
                        <a href="#" class="block hover:opacity-80 transition">Hubungi Kami</a>
                        <a href="#" class="block hover:opacity-80 transition">📞 +62 812 3456 7890</a>
                        <a href="#" class="block hover:opacity-80 transition">✉️ Jemplore@gmail.com</a>
                    </div>
                </div>
                
                <!-- Links Column 2 -->
                <div>
                    <p class="font-semibold mb-3">Media Sosial</p>
                    <div class="space-y-3">
                        <a href="#" class="block hover:opacity-80 transition">📷 Jemplore.id</a>
                        <a href="#" class="block hover:opacity-80 transition">📱 Jemplore.id</a>
                        <a href="#" class="block hover:opacity-80 transition">▶️ Jemplore.id</a>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-white border-opacity-20 pt-6 text-center text-sm">
                <p>Copyright 2025 Jemplore. All right reserved 103 written</p>
            </div>
        </div>
    </footer>

    <!-- Navbar Hover Script - Improved -->
    <script>
        const navbar = document.getElementById('navbar');
        const navbarHoverArea = document.querySelector('.navbar-hover-area');
        let isHovering = false;
        let hasScrolled = false;

        // Hover functionality
        navbarHoverArea.addEventListener('mouseenter', function() {
            isHovering = true;
            updateNavbar();
        });

        navbarHoverArea.addEventListener('mouseleave', function() {
            isHovering = false;
            updateNavbar();
        });

        // Scroll functionality
        window.addEventListener('scroll', function() {
            hasScrolled = window.scrollY > 50;
            updateNavbar();
        });

        function updateNavbar() {
            const menuLinks = navbar.querySelectorAll('ul li a');
            const loginText = navbar.querySelector('.flex.items-center.space-x-2 span');
            const loginIcon = navbar.querySelector('.flex.items-center.space-x-2 .bg-white');
            const logo = navbar.querySelector('img[alt="Jemplore Logo"]');
            
            if (isHovering || hasScrolled) {
                // Navbar putih dengan shadow
                navbar.classList.add('bg-white', 'shadow-lg');
                navbar.classList.remove('bg-opacity-0');
                
                // Menu links jadi hitam
                menuLinks.forEach(link => {
                    link.classList.remove('text-white', 'hover:text-primary-light', 'drop-shadow-lg');
                    link.classList.add('text-gray-700', 'hover:text-primary');
                });
                
                // Login text jadi hitam
                loginText.classList.remove('text-white', 'drop-shadow-lg');
                loginText.classList.add('text-gray-700');
                
                // Login icon background
                loginIcon.classList.remove('bg-white', 'bg-opacity-20', 'backdrop-blur-sm');
                loginIcon.classList.add('bg-gray-200');
                
                // Icon color
                const svg = loginIcon.querySelector('svg');
                svg.classList.remove('text-white', 'drop-shadow-lg');
                svg.classList.add('text-gray-600');
                
                // Logo shadow
                logo.classList.remove('drop-shadow-lg');
                logo.classList.add('drop-shadow-md');
            } else {
                // Navbar transparan
                navbar.classList.remove('bg-white', 'shadow-lg');
                
                // Menu links jadi putih
                menuLinks.forEach(link => {
                    link.classList.remove('text-gray-700', 'hover:text-primary');
                    link.classList.add('text-white', 'hover:text-primary-light', 'drop-shadow-lg');
                });
                
                // Login text jadi putih
                loginText.classList.remove('text-gray-700');
                loginText.classList.add('text-white', 'drop-shadow-lg');
                
                // Login icon background
                loginIcon.classList.remove('bg-gray-200');
                loginIcon.classList.add('bg-white', 'bg-opacity-20', 'backdrop-blur-sm');
                
                // Icon color
                const svg = loginIcon.querySelector('svg');
                svg.classList.remove('text-gray-600');
                svg.classList.add('text-white', 'drop-shadow-lg');
                
                // Logo shadow
                logo.classList.remove('drop-shadow-md');
                logo.classList.add('drop-shadow-lg');
            }
        }

        // Carousel Functionality
        const carousel = document.getElementById('eventCarousel');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('dotsContainer');
        
        let currentIndex = 0;
        let autoSlideTimer;
        let userInteractionTimer;
        const cardsPerView = window.innerWidth >= 768 ? 3 : 1;
        
        // Clone cards untuk infinite loop
        const originalCards = Array.from(carousel.children);
        const totalOriginalCards = originalCards.length;
        
        // Clone cards di awal dan akhir untuk seamless loop
        originalCards.forEach(card => {
            const clone = card.cloneNode(true);
            carousel.appendChild(clone);
        });
        
        originalCards.forEach(card => {
            const clone = card.cloneNode(true);
            carousel.insertBefore(clone, carousel.firstChild);
        });
        
        const allCards = carousel.children;
        const totalCards = allCards.length;
        
        // Set initial position (mulai dari card asli, bukan clone)
        currentIndex = totalOriginalCards;
        const cardWidth = allCards[0].offsetWidth;
        const gap = 32;
        carousel.style.transform = `translateX(-${currentIndex * (cardWidth + gap)}px)`;

        // Create dots
        function createDots() {
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalOriginalCards; i++) {
                const dot = document.createElement('button');
                dot.className = 'w-3 h-3 rounded-full transition-all duration-300';
                dot.onclick = () => goToSlide(i);
                dotsContainer.appendChild(dot);
            }
            updateDots();
        }

        // Update dots
        function updateDots() {
            const dots = dotsContainer.children;
            const actualIndex = ((currentIndex - totalOriginalCards) % totalOriginalCards + totalOriginalCards) % totalOriginalCards;
            for (let i = 0; i < dots.length; i++) {
                if (i === actualIndex) {
                    dots[i].classList.add('bg-primary', 'w-8');
                    dots[i].classList.remove('bg-gray-300');
                } else {
                    dots[i].classList.add('bg-gray-300');
                    dots[i].classList.remove('bg-primary', 'w-8');
                }
            }
        }

        // Update carousel position
        function updateCarousel(instant = false) {
            const cardWidth = allCards[0].offsetWidth;
            const gap = 32;
            const offset = currentIndex * (cardWidth + gap);
            
            if (instant) {
                carousel.style.transition = 'none';
            } else {
                carousel.style.transition = 'transform 0.5s ease-out';
            }
            
            carousel.style.transform = `translateX(-${offset}px)`;
            updateDots();
        }

        // Check for loop reset (seamless infinite loop)
        function checkLoop() {
            const cardWidth = allCards[0].offsetWidth;
            const gap = 32;
            
            // Jika sudah sampai clone di akhir, reset ke asli
            if (currentIndex >= totalOriginalCards * 2) {
                setTimeout(() => {
                    currentIndex = totalOriginalCards;
                    updateCarousel(true);
                }, 500);
            }
            
            // Jika sudah sampai clone di awal, reset ke asli
            if (currentIndex < totalOriginalCards) {
                setTimeout(() => {
                    currentIndex = totalOriginalCards * 2 - 1;
                    updateCarousel(true);
                }, 500);
            }
        }

        // Go to specific slide
        function goToSlide(index) {
            currentIndex = totalOriginalCards + index;
            updateCarousel();
            resetAutoSlide();
        }

        // Next slide
        function nextSlide() {
            currentIndex++;
            updateCarousel();
            checkLoop();
            resetAutoSlide();
        }

        // Previous slide
        function prevSlide() {
            currentIndex--;
            updateCarousel();
            checkLoop();
            resetAutoSlide();
        }

        // Auto slide functionality
        function startAutoSlide() {
            autoSlideTimer = setInterval(() => {
                nextSlide();
            }, 3000);
        }

        // Reset auto slide on user interaction
        function resetAutoSlide() {
            clearInterval(autoSlideTimer);
            clearTimeout(userInteractionTimer);
            
            userInteractionTimer = setTimeout(() => {
                startAutoSlide();
            }, 3000);
        }

        // Event listeners
        prevBtn.addEventListener('click', prevSlide);
        nextBtn.addEventListener('click', nextSlide);

        // Pause auto slide on hover
        carousel.addEventListener('mouseenter', () => {
            clearInterval(autoSlideTimer);
        });

        carousel.addEventListener('mouseleave', () => {
            resetAutoSlide();
        });

        // Initialize
        createDots();
        startAutoSlide();

        // Handle window resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const cardWidth = allCards[0].offsetWidth;
                const gap = 32;
                carousel.style.transition = 'none';
                carousel.style.transform = `translateX(-${currentIndex * (cardWidth + gap)}px)`;
                setTimeout(() => {
                    carousel.style.transition = 'transform 0.5s ease-out';
                }, 50);
            }, 250);
        });
    </script>
</body>
</html>