<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Pengajuan</title>
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

        .main-content { flex: 1; padding: 32px; overflow-y: auto; }
        .content-wrapper { max-width: 1400px; margin: 0 auto; }
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 24px; }

        .submission-card { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); }
        .submission-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px; }
        .submission-title { font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 4px; text-transform: capitalize; }
        .submission-date { font-size: 14px; color: #6b7280; }
        .submission-description { font-size: 14px; color: #374151; line-height: 1.5; }

        .badge { display: inline-flex; align-items: center; padding: 6px 12px; font-size: 13px; font-weight: 500; border-radius: 999px; gap: 6px; }
        .badge-pending { background-color: #fef3c7; color: #92400e; }
        .badge-approved { background-color: #d1fae5; color: #065f46; }
        .badge-rejected { background-color: #fee2e2; color: #991b1b; }
        .badge i { font-size: 12px; }

        .rejection-reason { background-color: #fef2f2; border: 1px solid #fecaca; border-radius: 8px; padding: 12px 16px; margin-top: 12px; }
        .rejection-reason-text { font-size: 13px; color: #991b1b; }

        @media (max-width: 768px) { .submission-header { flex-direction: column; gap: 12px; } }
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
                <a href="{{ route('owner.dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="{{ route('owner.profile.manage') }}" class="nav-link"><i class="fas fa-file-alt"></i> Kelola Profil</a>
                <a href="{{ route('owner.events.manage') }}" class="nav-link"><i class="far fa-calendar"></i> Kelola Event</a>
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link"><i class="fas fa-utensils"></i> Kelola Kuliner</a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Kinerja</a>
                <a href="{{ route('owner.submission.status') }}" class="nav-link active"><i class="far fa-file-alt"></i> Pengajuan</a>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('public.home') }}" class="nav-link" style="margin-bottom: 12px; color: #6b7280;"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <button class="logout-btn" type="submit" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <h1 class="page-title">Status Pengajuan</h1>

                @if(session('success'))
                    <div style="background-color: #d1fae5; color: #065f46; padding: 12px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0;">
                        {{ session('success') }}
                    </div>
                @endif

                @forelse($submissions as $submission)
                    <div class="submission-card">
                        <div class="submission-header">
                            <div>
                                <div class="submission-title">{{ str_replace('_', ' ', $submission->submission_type) }}</div>
                                <div class="submission-date">{{ $submission->created_at->format('d M Y, H:i') }}</div>
                            </div>

                            @if($submission->status == 'pending')
                                <span class="badge badge-pending"><i class="far fa-clock"></i> Menunggu</span>
                            @elseif($submission->status == 'approved')
                                <span class="badge badge-approved"><i class="fas fa-check-circle"></i> Disetujui</span>
                            @elseif($submission->status == 'rejected')
                                <span class="badge badge-rejected"><i class="fas fa-times-circle"></i> Rejected</span>
                            @endif
                        </div>

                        <div class="submission-description">
                            Perubahan pada:
                            @foreach(array_keys($submission->payload) as $key)
                                <span style="background: #f3f4f6; padding: 2px 6px; border-radius: 4px; font-size: 12px; margin-right: 4px;">{{ $key }}</span>
                            @endforeach
                        </div>

                        @if($submission->status == 'rejected' && $submission->admin_feedback)
                            <div class="rejection-reason">
                                <div class="rejection-reason-text">
                                    <strong>Alasan Penolakan:</strong> {{ $submission->admin_feedback }}
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <div style="text-align: center; padding: 40px; color: #6b7280; background: white; border-radius: 12px; border: 1px solid #e5e7eb;">
                        <i class="far fa-folder-open" style="font-size: 48px; margin-bottom: 16px; color: #d1d5db;"></i>
                        <p>Belum ada riwayat pengajuan.</p>
                    </div>
                @endforelse

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
