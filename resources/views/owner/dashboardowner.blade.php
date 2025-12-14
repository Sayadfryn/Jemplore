<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f9fafb; color: #111827; }
        .container { display: flex; min-height: 100vh; }

        .sidebar { width: 220px; background-color: white; border-right: 1px solid #e5e7eb; height: 100vh; position: sticky; top: 0; display: flex; flex-direction: column; flex-shrink: 0; }
        .sidebar-header { padding: 24px; }
        .sidebar-title { font-size: 18px; font-weight: 600; color: #111827; }
        .sidebar-subtitle { font-size: 12px; color: #6b7280; margin-top: 4px; }
        .sidebar-nav { padding: 0 12px; flex: 1; overflow-y: auto; }
        .nav-link { display: flex; align-items: center; padding: 10px 12px; margin-bottom: 4px; text-decoration: none; color: #374151; font-size: 14px; border-radius: 8px; transition: background-color 0.2s; }
        .nav-link:hover { background-color: #f3f4f6; }
        .nav-link.active { background-color: #14b8a6; color: white; font-weight: 500; }
        .nav-link i { width: 16px; margin-right: 12px; }
        .sidebar-footer { padding: 24px 12px; border-top: 1px solid #f3f4f6; margin-top: auto; }
        .logout-btn { display: flex; align-items: center; width: 100%; padding: 10px 12px; background: none; border: none; color: #374151; font-size: 14px; border-radius: 8px; cursor: pointer; transition: background-color 0.2s; }
        .logout-btn:hover { background-color: #f3f4f6; }
        .logout-btn i { width: 16px; margin-right: 12px; }

        .main-content { flex: 1; padding: 32px; }
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 24px; }

        .stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 32px; }
        .stat-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; }
        .stat-card-content { display: flex; justify-content: space-between; align-items: flex-start; }
        .stat-info { flex: 1; }
        .stat-label { font-size: 14px; color: #6b7280; margin-bottom: 4px; }
        .stat-value { font-size: 30px; font-weight: 700; color: #111827; margin: 8px 0; }
        .stat-change { font-size: 12px; color: #059669; margin-top: 8px; }
        .stat-change i { margin-right: 4px; }
        .stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; }
        .icon-blue { background-color: #dbeafe; color: #2563eb; }
        .icon-teal { background-color: #ccfbf1; color: #14b8a6; }
        .icon-cyan { background-color: #cffafe; color: #06b6d4; }

        .quick-actions { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; }
        .section-title { font-size: 16px; font-weight: 600; margin-bottom: 16px; }

        .actions-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .btn { display: inline-flex; align-items: center; padding: 10px 16px; font-size: 14px; font-weight: 500; border-radius: 8px; text-decoration: none; cursor: pointer; transition: all 0.2s; border: none; }
        .btn-primary { background-color: #14b8a6; color: white; }
        .btn-primary:hover { background-color: #0d9488; }
        .btn-secondary { background-color: white; color: #374151; border: 1px solid #d1d5db; }
        .btn-secondary:hover { background-color: #f9fafb; }

        .btn-danger { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .btn-danger:hover { background-color: #fecaca; color: #7f1d1d; }

        .btn i { margin-right: 8px; }

        @media (max-width: 768px) {
            .stats-grid { grid-template-columns: 1fr; }
            .actions-buttons { flex-direction: column; align-items: stretch; }

            .delete-form { margin-left: 0 !important; margin-top: 12px; }
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
                <a href="{{ route('owner.dashboard') }}" class="nav-link active"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="{{ route('owner.profile.manage') }}" class="nav-link"><i class="fas fa-file-alt"></i> Kelola Profil</a>
                <a href="{{ route('owner.events.manage') }}" class="nav-link"><i class="far fa-calendar"></i> Kelola Event</a>
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link"><i class="fas fa-utensils"></i> Kelola Kuliner</a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Kinerja</a>
                <a href="{{ route('owner.submission.status') }}" class="nav-link"><i class="far fa-file-alt"></i> Pengajuan</a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('public.home') }}" class="nav-link" style="margin-bottom: 12px; color: #6b7280;"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <button class="logout-btn" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <h1 class="page-title">Ringkasan Dashboard</h1>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-info">
                            <div class="stat-label">Total Ulasan</div>
                            <div class="stat-value">{{ auth()->user()->tourismObject->total_reviews ?? 0 }}</div>
                            <div class="stat-change"><i class="fas fa-arrow-up"></i> Sepanjang Waktu</div>
                        </div>
                        <div class="stat-icon icon-blue"><i class="fas fa-eye"></i></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-info">
                            <div class="stat-label">Rating Terkini</div>
                            <div class="stat-value">{{ auth()->user()->tourismObject->rating ?? 0 }}</div>
                            <div class="stat-change" style="color: #6b7280;">Dari 5.0</div>
                        </div>
                        <div class="stat-icon icon-teal"><i class="far fa-star"></i></div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-card-content">
                        <div class="stat-info">
                            <div class="stat-label">Pengajuan Tertunda</div>
                            <div class="stat-value">0</div> <div class="stat-change" style="color: #6b7280;">Menunggu Persetujuan</div>
                        </div>
                        <div class="stat-icon icon-cyan"><i class="far fa-clock"></i></div>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <h2 class="section-title">Tindakan Cepat</h2>
                <div class="actions-buttons">
                    <a href="{{ route('owner.profile.manage') }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Perbarui Profil
                    </a>
                    <a href="{{ route('owner.events.manage') }}" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Tambah Event
                    </a>
                    <a href="{{ route('owner.reports.performance') }}" class="btn btn-secondary">
                        <i class="fas fa-chart-bar"></i> Lihat Laporan
                    </a>

                    <form action="{{ route('owner.account.delete') }}" method="POST" class="delete-form" style="margin-left: auto;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('PERINGATAN! \n\nMenghapus akun akan MENGHAPUS SEMUA DATA wisata, kuliner, dan event Anda secara permanen.\n\nAnda yakin ingin melanjutkan?')">
                            <i class="fas fa-trash-alt"></i> Hapus Akun
                        </button>
                    </form>
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
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                // Simple active state (optional)
            });
        });
    </script>
</body>
</html>
