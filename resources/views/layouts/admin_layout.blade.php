<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Jemplore System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .sidebar {
            width: 280px;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">

        <aside class="sidebar bg-white shadow-xl flex flex-col justify-between">
            <div class="p-6">
                <h1 class="text-xl font-semibold text-gray-800 border-b pb-4 mb-4">Admin Portal</h1>
                <p class="text-sm text-gray-500 mb-8">Jemplore System</p>

                <nav class="space-y-2">
                    @include('layouts.admin_sidebar')
                </nav>
            </div>

            <div class="p-6 border-t space-y-4">
                <a href="{{ route('public.home') }}" class="flex items-center text-gray-500 hover:text-teal-600 transition duration-150 group">
                    <svg class="w-5 h-5 mr-3 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Logout?')" class="flex items-center text-red-500 hover:text-red-700 transition duration-150 w-full text-left">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 overflow-y-auto p-10">
            @yield('content')
        </main>
    </div>

    @yield('scripts')

</body>
</html>
