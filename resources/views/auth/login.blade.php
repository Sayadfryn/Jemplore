<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jemplore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Arimo', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="min-h-screen flex">

        <div class="hidden lg:block lg:w-1/2 relative bg-gray-900">
            <img src="{{ asset('storage/tumpak-sewu.png') }}"
                 class="absolute inset-0 w-full h-full object-cover opacity-90"
                 alt="Login Background">

            <div class="absolute inset-0 bg-gradient-to-t from-[#47b6c2]/90 via-[#47b6c2]/40 to-black/30 mix-blend-multiply"></div>

            <div class="absolute bottom-0 left-0 p-12 text-white z-10">
                <h2 class="text-4xl font-bold mb-4 leading-tight">Eksplor Pesona Tersembunyi<br>Kota Jember</h2>
                <p class="text-lg text-gray-100 max-w-md leading-relaxed">
                    Bergabunglah dengan komunitas kami untuk menjelajahi destinasi, memesan paket, dan mengelola acara dengan mudah.
                </p>
            </div>
        </div>

        <div class="flex-1 flex items-center justify-center p-6 bg-white relative">

            <div class="absolute inset-0 opacity-5 pointer-events-none overflow-hidden">
                <svg class="absolute -top-24 -right-24 w-96 h-96 text-[#47b6c2]" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" /></svg>
                <svg class="absolute bottom-0 left-0 w-64 h-64 text-[#47b6c2]" fill="currentColor" viewBox="0 0 100 100"><circle cx="50" cy="50" r="50" /></svg>
            </div>

            <div class="w-full max-w-md space-y-8 relative z-10">

                <div class="text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#47b6c2] to-[#5dd2de] shadow-lg mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 tracking-tight">Selamat Datang Kembali!</h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Silakan masuk untuk mengakses dashboard Anda.
                    </p>
                </div>

                <div class="mt-8 space-y-6">

                    @if(session('error'))
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-md">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <a href="{{ url('/auth/google') }}"
                       class="flex items-center justify-center w-full px-4 py-4 bg-white border border-gray-300 rounded-xl shadow-sm text-base font-medium text-gray-700 hover:bg-gray-50 hover:shadow-md transition-all duration-200 group relative overflow-hidden">

                        <svg class="w-6 h-6 mr-3" viewBox="0 0 48 48">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.341,43.611,20.083z"/>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.341,43.611,20.083z"/>
                        </svg>

                        <span>Sign in with Google</span>

                        <div class="absolute inset-0 bg-gray-100 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    </a>

                    <a href="{{ route('public.home') }}"
                    class="flex items-center justify-center w-full px-4 py-4 mt-3 bg-transparent border border-gray-200 text-gray-500 rounded-xl text-base font-medium hover:border-[#47b6c2] hover:text-[#47b6c2] transition-all duration-200 group">

                        <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>

                        Kembali ke Beranda
                    </a>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-400">Jemplore Tourism</span>
                        </div>
                    </div>
                </div>

                <p class="mt-8 text-center text-xs text-gray-400">
                    &copy; {{ date('Y') }} Jemplore. All rights reserved.<br>
                    <a href="#" class="hover:text-[#47b6c2] underline">Privacy Policy</a> &bull; <a href="#" class="hover:text-[#47b6c2] underline">Terms of Service</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
