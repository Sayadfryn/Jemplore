<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Kelola Event</title>
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
        .content-wrapper { max-width: 1200px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 24px; font-weight: 600; }

        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }

        .form-container { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .form-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 500; color: #111827; margin-bottom: 8px; }
        .form-input, .form-select, .form-textarea { width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; background-color: #f9fafb; transition: border-color 0.2s; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1); }
        .form-textarea { resize: vertical; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

        .btn { display: inline-flex; align-items: center; padding: 10px 20px; font-size: 14px; font-weight: 500; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background-color: #14b8a6; color: white; }
        .btn-primary:hover { background-color: #0d9488; }
        .btn-secondary { background-color: white; border: 1px solid #d1d5db; color: #374151; }
        .btn-secondary:hover { background-color: #f3f4f6; }
        .btn-danger { background-color: white; border: 1px solid #ef4444; color: #ef4444; }
        .btn-danger:hover { background-color: #fee2e2; }
        .btn i { margin-right: 8px; }

        .image-upload-box {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            background-color: #f9fafb;
            transition: all 0.2s;
            position: relative;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .image-upload-box:hover { border-color: #14b8a6; background-color: #f0fdfa; }
        .image-upload-box.has-image { padding: 0; }
        .image-preview { width: 100%; height: 150px; object-fit: cover; border-radius: 6px; display: none; }
        .image-upload-box.has-image .image-preview { display: block; }
        .image-upload-box.has-image .upload-placeholder { display: none; }

        .events-container { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; }
        .events-list { margin-top: 20px; }
        .event-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 12px;
            transition: background-color 0.2s;
        }
        .event-item:hover { background-color: #f9fafb; }
        .event-info h4 { font-size: 14px; font-weight: 500; color: #111827; margin-bottom: 4px; }
        .event-info p { font-size: 14px; color: #6b7280; }

        .badge { display: inline-block; padding: 4px 12px; font-size: 12px; font-weight: 500; border-radius: 999px; }
        .badge-upcoming { background-color: #dbeafe; color: #1e40af; }
        .badge-ongoing { background-color: #d1fae5; color: #065f46; }
        .badge-past { background-color: #f3f4f6; color: #6b7280; }

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

        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
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
                <a href="{{ route('owner.events.manage') }}" class="nav-link active">
                    <i class="far fa-calendar"></i>
                    Kelola Event
                </a>
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link">
                    <i class="fas fa-utensils"></i>
                    Kelola Kuliner
                </a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link">
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
                <div class="page-header">
                    <h1 class="page-title">Kelola Event</h1>
                    <button class="btn btn-primary" onclick="toggleForm()">
                        <i class="fas fa-plus"></i>
                        Tambah Event Baru
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert" style="background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">
                        <div style="font-weight: 600; margin-bottom: 4px;">
                            <i class="fas fa-exclamation-circle"></i> Error:
                        </div>
                        <ul style="margin-left: 20px; list-style-type: disc; font-size: 14px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-container" id="eventForm" style="display: none;">
                    <h2 class="form-title">Buat Event di Lokasi Anda</h2>

                    <form action="{{ route('owner.events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label class="form-label">Foto Event (Opsional)</label>
                            <div class="image-upload-box" id="imageBox" onclick="document.getElementById('imageInput').click()">
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt" style="font-size: 24px; color: #9ca3af; margin-bottom: 8px;"></i>
                                    <div style="font-size: 14px; color: #6b7280;">Click to upload image</div>
                                </div>
                                <img id="imagePreview" class="image-preview">
                                <input type="file" name="image" id="imageInput" style="display: none;" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nama Event</label>
                            <input type="text" name="title" class="form-input" placeholder="e.g., Sunrise Photography Workshop" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="start_date" class="form-input" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal Selesai (Opsional)</label>
                                <input type="date" name="end_date" class="form-input">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Waktu Event (Opsional)</label>
                            <input type="time" name="start_time" class="form-input">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Lokasi Event (Opsional)</label>
                            <input type="text" name="location_name" class="form-input" placeholder="Biarkan kosong jika sama dengan lokasi wisata">
                        </div>

                        <div class="form-group">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-textarea" rows="5" placeholder="Tuliskan deskripsi event..."></textarea>
                        </div>

                        <div style="display: flex; gap: 12px; justify-content: flex-end;">
                            <button type="button" class="btn btn-secondary" onclick="toggleForm()">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Simpan Event
                            </button>
                        </div>
                    </form>
                </div>

                <div class="events-container">
                    <h2 class="form-title">Event Anda</h2>

                    <div class="events-list">
                        @forelse($events as $event)
                            <div class="event-item">
                                <div class="event-info">
                                    <h4>{{ $event->title }}</h4>
                                    <p>
                                        {{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}
                                        @if($event->end_date && $event->end_date != $event->start_date)
                                            - {{ \Carbon\Carbon::parse($event->end_date)->format('d M Y') }}
                                        @endif
                                        @if($event->start_time)
                                            | {{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }} WIB
                                        @endif
                                    </p>
                                </div>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    @php
                                        $now = \Carbon\Carbon::now();
                                        $startDate = \Carbon\Carbon::parse($event->start_date)->startOfDay();
                                        $endDate = $event->end_date 
                                            ? \Carbon\Carbon::parse($event->end_date)->endOfDay() 
                                            : $startDate->copy()->endOfDay();

                                        $isFinished = $now->gt($endDate);
                                    @endphp

                                    @if($now->lt($startDate))
                                        <span class="badge badge-upcoming">Akan Datang</span>
                                    @elseif($now->between($startDate, $endDate))
                                        <span class="badge badge-ongoing">Sedang Berlangsung</span>
                                    @else
                                        <span class="badge badge-past">Selesai</span>
                                    @endif

                                    @if($isFinished)
                                        <button class="btn btn-secondary" style="padding: 8px; opacity: 0.6; cursor: not-allowed;" title="Event sudah selesai, tidak dapat diedit" disabled>
                                            <i class="fas fa-lock" style="margin:0"></i>
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" style="padding: 8px;" onclick='editEvent(@json($event))'>
                                            <i class="fas fa-edit" style="margin:0"></i>
                                        </button>
                                    @endif

                                    <form action="{{ route('owner.events.delete', $event->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 8px;" onclick="return confirm('Yakin ingin menghapus event ini?')">
                                            <i class="fas fa-trash" style="margin:0"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="far fa-calendar"></i>
                                <p>Belum ada event. Buat event pertama Anda sekarang!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        let isEditing = false;

        function resetForm() {
            isEditing = false;
            document.getElementById('eventForm').style.display = 'none';
            document.querySelector('.form-title').innerText = 'Buat Event di Lokasi Anda';
            
            const form = document.querySelector('form');
            form.reset();
            form.action = "{{ route('owner.events.store') }}";

            const today = new Date().toISOString().split('T')[0];
            const startDateInput = document.querySelector('input[name="start_date"]');
            const endDateInput = document.querySelector('input[name="end_date"]');
            
            startDateInput.setAttribute('min', today);
            endDateInput.removeAttribute('min');
            
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-paper-plane"></i> Simpan Event';
            
            document.getElementById('imageBox').classList.remove('has-image');
            document.getElementById('imagePreview').src = '';
        }

        function toggleForm() {
            const formDiv = document.getElementById('eventForm');
            
            if (formDiv.style.display === 'none' || isEditing) {
                if(isEditing) resetForm(); 
                formDiv.style.display = 'block';
                formDiv.scrollIntoView({ behavior: 'smooth' });
            } else {
                formDiv.style.display = 'none';
            }
        }

        function editEvent(data) {
            isEditing = true;
            const formDiv = document.getElementById('eventForm');
            const form = formDiv.querySelector('form');
            
            document.querySelector('.form-title').innerText = 'Edit Event: ' + data.title;
            formDiv.style.display = 'block';
            form.action = `/owner/events/${data.id}`;
            formDiv.scrollIntoView({ behavior: 'smooth' });

            if (!form.querySelector('input[name="_method"]')) {
                const hiddenMethod = document.createElement('input');
                hiddenMethod.type = 'hidden';
                hiddenMethod.name = '_method';
                hiddenMethod.value = 'PUT';
                form.prepend(hiddenMethod);
            }

            form.querySelector('input[name="title"]').value = data.title;
            form.querySelector('textarea[name="description"]').value = data.description || '';
            form.querySelector('input[name="location_name"]').value = data.location_name || '';
            
            const startDateStr = data.start_date.substring(0, 10);
            const startDateInput = form.querySelector('input[name="start_date"]');
            const endDateInput = form.querySelector('input[name="end_date"]');

            startDateInput.value = startDateStr;
            
            startDateInput.removeAttribute('min'); 

            endDateInput.setAttribute('min', startDateStr);

            if(data.end_date) {
                endDateInput.value = data.end_date.substring(0, 10);
            }

            if(data.start_time) {
                form.querySelector('input[name="start_time"]').value = data.start_time.substring(0, 5);
            }

            if (data.image) {
                document.getElementById('imageBox').classList.add('has-image');
                document.getElementById('imagePreview').src = `/storage/${data.image}`;
            } else {
                document.getElementById('imageBox').classList.remove('has-image');
                document.getElementById('imagePreview').src = '';
            }

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync"></i> Update Event';
        }

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const box = document.getElementById('imageBox');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    box.classList.add('has-image');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.querySelector('input[name="start_date"]');
            const endDateInput = document.querySelector('input[name="end_date"]');

            const today = new Date().toISOString().split('T')[0];

            startDateInput.setAttribute('min', today);

            startDateInput.addEventListener('change', function() {
                endDateInput.setAttribute('min', this.value);

                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = this.value;
                }
            });
        });
    </script>
</body>
</html>
