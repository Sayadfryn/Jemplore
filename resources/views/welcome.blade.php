<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jemplore - Jember Explore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Jemplore Logo" class="h-12">
                </div>
                
                <!-- Menu -->
                <ul class="hidden md:flex space-x-8 text-gray-700 font-medium">
                    <li><a href="#jelajahi" class="hover:text-teal-500 transition">Jelajahi</a></li>
                    <li><a href="#menu2" class="hover:text-teal-500 transition">Menu 2</a></li>
                    <li><a href="#menu3" class="hover:text-teal-500 transition">Menu 3</a></li>
                </ul>
                
                <!-- Login -->
                <div class="flex items-center space-x-2 cursor-pointer hover:opacity-80 transition">
                    <div class="w-8 h-8 bg-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-gray-700 font-medium">Login</span>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-[500px] mt-20 bg-cover bg-center flex items-center justify-center" style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('{{ asset('images/hero-bg.jpg') }}');">
        <div class="text-center text-white px-4">
            <p class="text-teal-400 text-lg md:text-xl mb-3">Selamat Datang Di Pulsa Karnaval</p>
            <h1 class="text-6xl md:text-8xl font-bold tracking-wider mb-3">Jember</h1>
            <p class="text-teal-400 text-lg md:text-xl">Dengan Beribui Keindahannya</p>
        </div>
    </section>

    <!-- Jemplore Info Section -->
    <section class="bg-gradient-to-br from-teal-400 to-teal-600 py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">
                <!-- Left Content -->
                <div class="text-white">
                    <h2 class="text-5xl md:text-6xl font-bold italic mb-6">Jemplore</h2>
                    <p class="text-base leading-relaxed mb-6 text-justify">
                        Jemplore Merupakan Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed dignissim, arcu sed suscipit gravida, mauris lorem fermentum massa, at placerat orci nibh id neque. Nulla vestibulum nuam ac elit viverra, ut gravida leo faucibus. Suspendisse elementum sem sit amet neque suscipit, vitae laoreet erat cursus. Sed blandit mi ut risus ornare, vitae vehicula nunc ullamcorper. Integer sit amet ante a urna pellentesque dignissim.
                    </p>
                    <p class="font-semibold text-lg mb-6">Masuk Untuk Pengalaman yang lebih Memukau</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="bg-white text-teal-500 px-10 py-3 rounded-full font-semibold hover:shadow-lg hover:-translate-y-1 transition transform">
                            Sign in
                        </button>
                        <button class="bg-gray-800 text-white px-10 py-3 rounded-full font-semibold hover:bg-gray-900 hover:-translate-y-1 transition transform">
                            Login
                        </button>
                    </div>
                </div>
                
                <!-- Right Image -->
                <div>
                    <img src="{{ asset('images/beach.jpg') }}" alt="Beach View" class="rounded-2xl shadow-2xl w-full">
                </div>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section class="py-16 md:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">
                    Acara Yang Tidak Boleh Terlewatkan
                </h2>
                <button class="bg-white border-2 border-teal-500 text-teal-500 px-6 py-2 rounded-full font-semibold hover:bg-teal-500 hover:text-white transition">
                    Jelajahi Acara →
                </button>
            </div>
            
            <!-- Event Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
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
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                    <img src="{{ asset('images/event2.jpg') }}" alt="Bornoday Land" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Bornoday Land</h3>
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
                
                <!-- Card 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:-translate-y-2 transition transform duration-300">
                    <img src="{{ asset('images/event3.jpg') }}" alt="Auten Soi" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Auten Soi</h3>
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
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-teal-400 to-teal-600 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Logo -->
                <div>
                    <img src="{{ asset('images/logo-white.png') }}" alt="Jemplore" class="h-16 mb-4">
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
</body>
</html>