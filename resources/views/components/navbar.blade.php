@props(['isActive' => 'home'])
@php
    $nav = [
        ['menu' => 'Destinasi', 'link' => '/destination'],
        ['menu' => 'Kuliner', 'link' => '/culinary'],
        ['menu' => 'Events', 'link' => '/event'],
        ['menu' => 'Paket Wisata', 'link' => 'package'],
    ];
@endphp
<nav class="w-full bg-white/95 backdrop-blur-sm border-b border-[#98dce4]/30 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <div class="flex items-center gap-2">
                <div class="w-10 h-10 rounded-[10px] bg-gradient-to-b from-[#47b6c2] to-[#5dd2de] flex items-center justify-center relative shadow-sm">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19.9901 9.99506C19.9901 14.9856 14.4538 20.183 12.5947 21.7882C12.4215 21.9184 12.2107 21.9889 11.994 21.9889C11.7773 21.9889 11.5665 21.9184 11.3933 21.7882C9.53424 20.183 3.99799 14.9856 3.99799 9.99506C3.99799 7.87438 4.84042 5.84055 6.33997 4.34101C7.83952 2.84146 9.87334 1.99902 11.994 1.99902C14.1147 1.99902 16.1485 2.84146 17.6481 4.34101C19.1476 5.84055 19.9901 7.87438 19.9901 9.99506Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M11.9941 12.9936C13.6501 12.9936 14.9926 11.6511 14.9926 9.99509C14.9926 8.33906 13.6501 6.99658 11.9941 6.99658C10.338 6.99658 8.99554 8.33906 8.99554 9.99509C8.99554 11.6511 10.338 12.9936 11.9941 12.9936Z" stroke="white" stroke-width="1.99901" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <div class="flex flex-col">
                    <span class="text-[#060b0b] text-base font-bold leading-tight tracking-tight">
                        Jemplore
                    </span>
                    <span class="text-[#47b6c2] text-xs font-normal">
                        Jember Explore
                    </span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-1">

                <a href="/" class="px-4 py-2 {{ $isActive == 'home' ? 'bg-[#47b6c2]/10 rounded-[10px] text-[#47b6c2]' : 'text-[#060b0b]' }} text-base rounded-[10px] font-medium transition hover:bg-gray-50 hover:text-[#47b6c2]">
                    Beranda
                </a>

                @foreach($nav as $menu)
                    <a href="{{ $menu['link'] }}" class="px-4 py-2 {{ $isActive == $menu['menu'] ? 'bg-[#47b6c2]/10 rounded-[10px] text-[#47b6c2]' : 'text-[#060b0b]' }} text-base font-medium rounded-[10px] hover:bg-gray-50 hover:text-[#47b6c2] transition">
                        {{ $menu['menu'] }}
                    </a>
                @endforeach
            </div>

            <div class="flex items-center gap-3">
                @auth
                    <div class="hidden lg:flex flex-col items-end mr-2">
                        <span class="text-[10px] text-gray-500 leading-tight">Halo,</span>
                        <span class="text-sm font-bold text-[#060b0b] leading-tight max-w-[100px] truncate">
                            {{ Auth::user()->name }}
                        </span>
                    </div>

                    @if(Auth::user()->role === 'admin')

                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 bg-[#060b0b] hover:bg-gray-800 text-white px-4 py-2 rounded-lg transition shadow-md text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Dashboard
                        </a>

                    @elseif(Auth::user()->role === 'owner')

                        <a href="{{ route('owner.dashboard') }}" class="flex items-center gap-2 bg-[#47b6c2] hover:bg-[#3da0aa] text-white px-4 py-2 rounded-lg transition shadow-md text-sm font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Manage Wisata
                        </a>

                    @else

                        <a href="{{ route('submission.create') }}" class="flex items-center gap-2 bg-white border border-[#47b6c2] text-[#47b6c2] hover:bg-[#47b6c2] hover:text-white px-4 py-2 rounded-lg transition shadow-sm text-sm font-medium group">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Ajukan Owner
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Logout?')" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition" title="Logout">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </button>
                    </form>

                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 bg-[#47b6c2] hover:bg-[#3da0aa] text-white px-4 py-2 rounded-lg transition shadow-md group">
                        <svg class="w-4 h-4 text-white group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="text-sm font-medium">Login</span>
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
