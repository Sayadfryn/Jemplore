<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Kinerja</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f9fafb; color: #111827; }
        .container { display: flex; min-height: 100vh; }

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

        .sidebar-header { padding: 24px; }
        .sidebar-title { font-size: 18px; font-weight: 600; color: #111827; }
        .sidebar-subtitle { font-size: 12px; color: #6b7280; margin-top: 4px; }
        .sidebar-nav { padding: 0 12px; flex: 1; overflow-y: auto; }
        .nav-link { display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; text-decoration: none; color: #374151; font-size: 14px; border-radius: 8px; transition: background-color 0.2s; }
        .nav-link:hover { background-color: #c9c9c9; }
        .nav-link.active { background-color: #14b8a6; color: white; font-weight: 500; }
        .nav-link i { width: 16px; margin-right: 12px; }
        .sidebar-footer { padding: 24px 12px; border-top: 1px solid #f3f4f6; margin-top: auto; }
        .logout-btn { display: flex; align-items: center; width: 100%; padding: 10px 12px; background: none; border: none; color: #374151; font-size: 14px; border-radius: 8px; cursor: pointer; transition: background-color 0.2s; }
        .logout-btn:hover { background-color: #c9c9c9; }
        .logout-btn i { width: 16px; margin-right: 12px; }

        .main-content { flex: 1; padding: 32px; overflow-y: auto; }
        .content-wrapper { max-width: 1400px; margin: 0 auto; }
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 24px; }

        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 32px; }
        .stat-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); }
        .stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 16px; }
        .icon-blue { background-color: #dbeafe; color: #2563eb; }
        .icon-teal { background-color: #ccfbf1; color: #14b8a6; }
        .icon-amber { background-color: #fef3c7; color: #d97706; }
        .stat-label { font-size: 14px; color: #6b7280; margin-bottom: 8px; }
        .stat-value { font-size: 32px; font-weight: 700; color: #111827; margin-bottom: 4px; }
        .stat-subtitle { font-size: 12px; color: #6b7280; }

        .performance-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); }
        .card-title { font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 20px; }

        .rating-breakdown { display: flex; flex-direction: column; gap: 12px; }
        .rating-row { display: flex; align-items: center; gap: 12px; }
        .rating-label { width: 60px; font-size: 14px; color: #6b7280; display: flex; align-items: center; gap: 4px; }
        .rating-bar-container { flex: 1; height: 8px; background-color: #f3f4f6; border-radius: 4px; overflow: hidden; }
        .rating-bar { height: 100%; background-color: #14b8a6; transition: width 0.3s; }
        .rating-count { width: 40px; text-align: right; font-size: 14px; color: #6b7280; }

        .review-item {
            padding: 16px;
            border-bottom: 1px solid #f3f4f6;
        }
        .review-item:last-child {
            border-bottom: none;
        }
        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .reviewer-name {
            font-weight: 600;
            color: #111827;
        }
        .review-rating {
            display: flex;
            align-items: center;
            gap: 4px;
            color: #d97706;
            font-size: 14px;
        }
        .review-date {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .review-text {
            font-size: 14px;
            color: #374151;
            line-height: 1.5;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }
        .empty-state i {
            font-size: 64px;
            color: #d1d5db;
            margin-bottom: 16px;
        }

        @media (max-width: 968px) {
            .stats-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">Owner Portal</div>
                <div class="sidebar-subtitle">{{ auth()->user()->tourismObject->name ?? 'Wisata Anda' }}</div>
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

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon icon-blue">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-label">Total Ulasan</div>
                        <div class="stat-value">{{ $totalReviews }}</div>
                        <div class="stat-subtitle">Sepanjang Waktu</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-teal">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-label">Rating Rata-rata</div>
                        <div class="stat-value">{{ $averageRating }}</div>
                        <div class="stat-subtitle">Dari 5.0</div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon icon-amber">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="stat-label">Total Rating</div>
                        <div class="stat-value">{{ $totalRating }}</div>
                        <div class="stat-subtitle">Akumulasi Bintang</div>
                    </div>
                </div>

                <div class="performance-card">
                    <h2 class="card-title">Distribusi Rating</h2>

                    @if($totalReviews > 0)
                        <div class="rating-breakdown">
                            @for($i = 5; $i >= 1; $i--)
                                @php
                                    $count = $ratingDistribution[$i];
                                    $percentage = ($totalReviews > 0) ? ($count / $totalReviews * 100) : 0;
                                @endphp
                                <div class="rating-row">
                                    <div class="rating-label">
                                        <i class="fas fa-star" style="color: #d97706;"></i>
                                        {{ $i }}
                                    </div>
                                    <div class="rating-bar-container">
                                        <div class="rating-bar" style="width: {{ $percentage }}%"></div>
                                    </div>
                                    <div class="rating-count">{{ $count }}</div>
                                </div>
                            @endfor
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="far fa-chart-bar"></i>
                            <p>Belum ada data rating</p>
                        </div>
                    @endif
                </div>

                <div class="performance-card">
                    <h2 class="card-title">Ulasan Terbaru</h2>

                    @forelse($recentReviews as $review)
                        <div class="review-item">
                            <div class="review-header">
                                <div class="reviewer-name">{{ $review->user->name }}</div>
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star" style="color: {{ $i <= $review->rating ? '#d97706' : '#e5e7eb' }}"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="review-date">{{ $review->created_at->format('d M Y, H:i') }}</div>
                            <div class="review-text">{{ $review->comment }}</div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="far fa-comment-dots"></i>
                            <p>Belum ada ulasan</p>
                        </div>
                    @endforelse
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
