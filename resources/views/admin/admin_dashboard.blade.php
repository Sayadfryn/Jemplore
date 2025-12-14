@extends('layouts.admin_layout')

@section('content')
    <h2 class="text-3xl font-light text-gray-800 mb-8 border-b pb-4">Ringkasan Sistem</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                <h3 class="text-3xl font-semibold text-gray-900 mt-1">{{ number_format($totalUsers) }}</h3>
                <p class="text-xs text-green-500 mt-1 flex items-center">
                    <span class="mr-1">●</span> Pengguna Aktif
                </p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full text-blue-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Destinasi Aktif</p>
                <h3 class="text-3xl font-semibold text-gray-900 mt-1">{{ $totalDestinasi }}</h3>
                <p class="text-xs text-gray-400 mt-1">Lokasi Terverifikasi</p>
            </div>
            <div class="bg-green-100 p-3 rounded-full text-green-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition cursor-pointer group" onclick="window.location.href='{{ route('admin.reviews.all') }}'">
            <div>
                <p class="text-sm font-medium text-gray-500">Total Ulasan</p>
                <h3 class="text-3xl font-semibold text-gray-900 mt-1">{{ number_format($totalReviews) }}</h3>
                <a href="{{ route('admin.reviews.all') }}" class="text-xs text-teal-500 mt-1 flex items-center hover:text-teal-700 font-medium">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat Semua Ulasan
                </a>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full text-indigo-500 group-hover:bg-indigo-200 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                </svg>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-500">Tindakan Tertunda</p>
                <h3 class="text-3xl font-semibold text-gray-900 mt-1">{{ $pendingCount }}</h3>
                <p class="text-xs text-red-500 mt-1">Perlu Diverifikasi</p>
            </div>
            <div class="bg-orange-100 p-3 rounded-full text-orange-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>

    </div>

    <h3 class="text-xl font-medium text-gray-800 mb-4">Tindakan Cepat</h3>
    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex flex-wrap gap-4">

        <a href="{{ route('admin.verification') }}" class="flex items-center px-4 py-2 bg-teal-500 text-white rounded-lg hover:bg-teal-600 transition duration-150 shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Konten Ulasan (<span class="font-bold ml-1">{{ $pendingCount }}</span>)
        </a>

        <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-150 shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H9a2 2 0 01-2-2v-1a4 4 0 014-4h2a4 4 0 014 4v1a2 2 0 01-2 2z"></path>
            </svg>
            Kelola Pengguna
        </a>

        <a href="{{ route('admin.masterdata') }}" class="flex items-center px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition duration-150 shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10m-4 0h16M4 7h16M4 7h16"></path>
            </svg>
            Data Master
        </a>

        <a href="{{ route('admin.reports') }}" class="flex items-center px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition duration-150 shadow-md">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Lihat Laporan
        </a>
    </div>

@endsection
