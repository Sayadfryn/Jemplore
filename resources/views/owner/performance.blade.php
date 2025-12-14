<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Kinerja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9fafb;
            color: #111827;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: white;
            border-right: 1px solid #e5e7eb;
            height: 100vh;
            position: sticky;
            top: 0;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 24px;
        }

        .sidebar-title {
            font-size: 18px;
            font-weight: 600;
            color: #111827;
        }

        .sidebar-subtitle {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }

        .sidebar-nav {
            padding: 0 12px;
            flex: 1;
            overflow-y: auto;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            margin-bottom: 4px;
            text-decoration: none;
            color: #374151;
            font-size: 14px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }

        .nav-link:hover {
            background-color: #c9c9c9;
        }

        .nav-link.active {
            background-color: #14b8a6;
            color: white;
            font-weight: 500;
        }

        .nav-link i {
            width: 16px;
            margin-right: 12px;
        }

        .sidebar-footer {
            padding: 24px 12px;
            border-top: 1px solid #f3f4f6;
            margin-top: auto;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px 12px;
            background: none;
            border: none;
            color: #374151;
            font-size: 14px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .logout-btn:hover {
            background-color: #c9c9c9;
        }

        .logout-btn i {
            width: 16px;
            margin-right: 12px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 32px;
            overflow-y: auto;
        }

        .content-wrapper {
            max-width: 1400px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        /* Performance Grid */
        .performance-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        /* Performance Card */
        .performance-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .card-title {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 24px;
        }

        .chart-container {
            background: linear-gradient(135deg, #f0fdfa 0%, #ccfbf1 100%);
            border-radius: 12px;
            padding: 48px 24px;
            text-align: center;
            min-height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .chart-icon {
            font-size: 48px;
            color: #14b8a6;
            margin-bottom: 16px;
        }

        .chart-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 8px;
        }

        .chart-value {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
        }

        @media (max-width: 968px) {
            .performance-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">Owner Portal</div>
                <div class="sidebar-subtitle">Tumpak Sewu Waterfall</div>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('owner.dashboard') }}" class="nav-link">
                    <i class="fas fa-th-large"></i>
                    Dashboard
                </a>
                <a href="{{ route('owner.profile.manage') }}" class="nav-link">
                    <i class="fas fa-file-alt"></i>
                    Kelola Profil
                </a>
                <a href="{{ route('owner.events.manage') }}" class="nav-link">
                    <i class="far fa-calendar"></i>
                    Kelola Event
                </a>
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link">
                    <i class="fas fa-utensils"></i>
                    Kelola Kuliner
                </a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link active">
                    <i class="fas fa-chart-bar"></i>
                    Kinerja
                </a>
                <a href="{{ route('owner.submission.status') }}" class="nav-link">
                    <i class="far fa-file-alt"></i>
                    Pengajuan
                </a>
            </nav>

            <div class="sidebar-footer">

                <a href="{{ route('public.home') }}" class="nav-link" style="margin-bottom: 12px; color: #6b7280;">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Beranda
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <button class="logout-btn" onclick="confirmLogout()">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <h1 class="page-title">Laporan Kinerja</h1>

                <div class="performance-grid">
                    <div class="performance-card">
                        <h2 class="card-title">Tayangan Halaman</h2>
                        <div class="chart-container">
                            <i class="fas fa-chart-bar chart-icon"></i>
                            <div class="chart-label">Grafik Tayangan</div>
                            <div class="chart-value">12.458 Tayangan Total</div>
                        </div>
                    </div>

                    <div class="performance-card">
                        <h2 class="card-title">Tren Ulasan</h2>
                        <div class="chart-container">
                            <i class="far fa-comment-dots chart-icon"></i>
                            <div class="chart-label">Analisis Ulasan</div>
                            <div class="chart-value">Rating Rata-rata: 4,9</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function confirmLogout() {
        if (confirm('Apakah Anda yakin ingin logout?')) {
            document.getElementById('logout-form').submit();
        }
    }
    </script>
</body>
</html>
