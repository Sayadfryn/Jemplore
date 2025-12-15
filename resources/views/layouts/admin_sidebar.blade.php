@php
    $navItems = [
        ['route' => 'admin.dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l-2 2m0 0l-7 7 7 7m2-10V7a1 1 0 00-1-1h-3', 'label' => 'Dashboard', 'isActive' => (request()->routeIs('admin.dashboard'))],
        ['route' => 'admin.verification', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'label' => 'Verifikasi Konten', 'isActive' => (request()->routeIs('admin.verification'))],
        ['route' => 'admin.users', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H9a2 2 0 01-2-2v-1a4 4 0 014-4h2a4 4 0 014 4v1a2 2 0 01-2 2z', 'label' => 'Pengelolaan Pengguna', 'isActive' => (request()->routeIs('admin.users'))],
        ['route' => 'admin.masterdata', 'icon' => 'M4 7v10m-4 0h16M4 7h16M4 7h16', 'label' => 'Data Master', 'isActive' => (request()->routeIs('admin.masterdata'))],
        ['route' => 'admin.reports', 'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 0H7m12 0a2 2 0 100-4 2 2 0 000 4z', 'label' => 'Laporan Kinerja Sistem', 'isActive' => (request()->routeIs('admin.reports'))],
        ['route' => 'admin.settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z', 'label' => 'Pengaturan', 'isActive' => (request()->routeIs('admin.settings'))],
    ];
@endphp

@foreach ($navItems as $item)
    @php
        $isActive = $item['isActive'] ?? false;
        $baseClasses = 'flex items-center px-4 py-2 rounded-lg text-sm transition duration-150';
        $activeClasses = 'bg-teal-500 text-white shadow-md';
        $inactiveClasses = 'text-gray-600 hover:bg-gray-100 hover:text-gray-800';
        $class = $isActive ? $baseClasses . ' ' . $activeClasses : $baseClasses . ' ' . $inactiveClasses;
    @endphp

    <a href="{{ route($item['route']) }}" class="{{ $class }}">
        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"></path>
        </svg>
        <span>{{ $item['label'] }}</span>
    </a>
@endforeach
