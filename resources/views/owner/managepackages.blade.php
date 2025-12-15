<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Kelola Paket Wisata</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Reusing styles from manageevents/manageculinary for consistency */
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
        .content-wrapper { max-width: 1200px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 24px; font-weight: 600; }
        .btn { display: inline-flex; align-items: center; padding: 10px 20px; font-size: 14px; font-weight: 500; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background-color: #14b8a6; color: white; }
        .btn-primary:hover { background-color: #0d9488; }
        .btn-secondary { background-color: white; border: 1px solid #d1d5db; color: #374151; }
        .btn-secondary:hover { background-color: #f3f4f6; }
        .btn-danger { background-color: white; border: 1px solid #ef4444; color: #ef4444; }
        .btn-danger:hover { background-color: #fee2e2; }
        .btn i { margin-right: 8px; }
        .alert-success { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; }
        .form-container { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .form-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 500; color: #111827; margin-bottom: 8px; }
        .form-input, .form-textarea { width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; background-color: #f9fafb; transition: border-color 0.2s; }
        .form-input:focus, .form-textarea:focus { outline: none; border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1); }
        .image-upload-box { border: 2px dashed #d1d5db; border-radius: 8px; padding: 32px; text-align: center; cursor: pointer; background-color: #f9fafb; position: relative; min-height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center; }
        .image-upload-box:hover { border-color: #14b8a6; background-color: #f0fdfa; }
        .image-preview { width: 100%; height: 150px; object-fit: cover; border-radius: 6px; display: none; }
        .image-upload-box.has-image .image-preview { display: block; }
        .image-upload-box.has-image .upload-placeholder { display: none; }
        .package-card { display: flex; background: white; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; margin-bottom: 16px; }
        .package-img { width: 120px; height: 120px; object-fit: cover; }
        .package-content { padding: 16px; flex: 1; display: flex; flex-direction: column; justify-content: center; }
        .package-title { font-weight: 600; color: #111827; font-size: 16px; margin-bottom: 4px; }
        .package-price { font-size: 14px; color: #14b8a6; font-weight: 600; margin-bottom: 8px; }
        .package-features { display: flex; flex-wrap: wrap; gap: 6px; }
        .feature-tag { background: #f3f4f6; color: #4b5563; font-size: 11px; padding: 2px 8px; border-radius: 4px; }
        .package-actions { padding: 16px; display: flex; flex-direction: column; justify-content: center; gap: 8px; border-left: 1px solid #f3f4f6; }
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
                <a href="{{ route('owner.packages.manage') }}" class="nav-link active"><i class="fas fa-box-open"></i> Kelola Paket</a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Kinerja</a>
                <a href="{{ route('owner.submission.status') }}" class="nav-link"><i class="far fa-file-alt"></i> Pengajuan</a>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('public.home') }}" class="nav-link" style="color: #6b7280;"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <button class="logout-btn" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">Paket Wisata</h1>
                    <button class="btn btn-primary" onclick="toggleForm()">
                        <i class="fas fa-plus"></i> Tambah Paket
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-container" id="packageForm" style="display: none;">
                    <h2 class="form-title">Buat Paket Baru</h2>
                    <form action="{{ route('owner.packages.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Foto Paket (Thumbnail)</label>
                            <div class="image-upload-box" id="imageBox" onclick="document.getElementById('imageInput').click()">
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400 mb-2"></i>
                                    <div class="text-sm text-gray-500">Klik untuk upload gambar</div>
                                </div>
                                <img id="imagePreview" class="image-preview">
                                <input type="file" name="thumbnail" id="imageInput" class="hidden" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Nama Paket</label>
                            <input type="text" name="name" class="form-input" placeholder="Contoh: Paket Honeymoon 3H2M" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Harga (Rp)</label>
                            <input type="number" name="price" class="form-input" placeholder="Contoh: 1500000" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Fitur / Fasilitas</label>
                            <textarea name="features" class="form-textarea" rows="4" placeholder="Tulis fitur per baris. Contoh:&#10;Makan 3x Sehari&#10;Guide Profesional&#10;Dokumentasi" required></textarea>
                            <small class="text-gray-500 text-xs">Pisahkan setiap fasilitas dengan baris baru (Enter).</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Deskripsi Lengkap</label>
                            <textarea name="description" class="form-textarea" rows="4" placeholder="Jelaskan detail itinerary dan keunggulan paket ini..." required></textarea>
                        </div>

                        <div class="flex justify-end gap-3 mt-6">
                            <button type="button" class="btn btn-secondary" onclick="toggleForm()">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Paket
                            </button>
                        </div>
                    </form>
                </div>

                <div>
                    @forelse($packages as $package)
                        <div class="package-card">
                            <img src="{{ $package->thumbnail ? asset('storage/' . $package->thumbnail) : 'https://via.placeholder.com/150' }}" class="package-img">
                            <div class="package-content">
                                <div class="package-title">{{ $package->name }}</div>
                                <div class="package-price">Rp {{ number_format($package->price, 0, ',', '.') }}</div>
                                <p class="text-sm text-gray-500 mb-2 line-clamp-1">{{ $package->description }}</p>
                                <div class="package-features">
                                    @if(is_array($package->features))
                                        @foreach(array_slice($package->features, 0, 4) as $feature)
                                            <span class="feature-tag">{{ $feature }}</span>
                                        @endforeach
                                        @if(count($package->features) > 4)
                                            <span class="feature-tag">+{{ count($package->features) - 4 }} more</span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="package-actions">
                                <button class="btn btn-secondary" style="padding: 6px;" onclick='editPackage(@json($package))'>
                                    <i class="fas fa-edit" style="margin:0"></i>
                                </button>
                                <form action="{{ route('owner.packages.delete', $package->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 6px;" onclick="return confirm('Yakin hapus paket ini?')">
                                        <i class="fas fa-trash" style="margin:0"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state bg-white rounded-xl p-8 border border-gray-200 text-center">
                            <i class="fas fa-box-open text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500">Belum ada paket wisata. Buat penawaran menarik sekarang!</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </main>
    </div>

    <script>
        let isEditing = false;

        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
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

        function resetForm() {
            isEditing = false;
            document.getElementById('packageForm').style.display = 'none';
            document.querySelector('.form-title').innerText = 'Buat Paket Baru';
            const form = document.querySelector('form');
            form.reset();
            form.action = "{{ route('owner.packages.store') }}";
            
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save"></i> Simpan Paket';
            document.getElementById('imageBox').classList.remove('has-image');
            document.getElementById('imagePreview').src = '';
        }

        function toggleForm() {
            const formDiv = document.getElementById('packageForm');
            if (formDiv.style.display === 'none' || isEditing) {
                if(isEditing) resetForm();
                formDiv.style.display = 'block';
                formDiv.scrollIntoView({ behavior: 'smooth' });
            } else {
                formDiv.style.display = 'none';
            }
        }

        function editPackage(data) {
            isEditing = true;
            const formDiv = document.getElementById('packageForm');
            const form = formDiv.querySelector('form');
            
            document.querySelector('.form-title').innerText = 'Edit Paket: ' + data.name;
            formDiv.style.display = 'block';
            form.action = `/owner/packages/${data.id}`;
            formDiv.scrollIntoView({ behavior: 'smooth' });

            if (!form.querySelector('input[name="_method"]')) {
                const hiddenMethod = document.createElement('input');
                hiddenMethod.type = 'hidden';
                hiddenMethod.name = '_method';
                hiddenMethod.value = 'PUT';
                form.prepend(hiddenMethod);
            }

            form.querySelector('input[name="name"]').value = data.name;
            form.querySelector('input[name="price"]').value = Math.floor(data.price);
            form.querySelector('textarea[name="description"]').value = data.description;
            
            if(Array.isArray(data.features)) {
                form.querySelector('textarea[name="features"]').value = data.features.join('\n');
            }

            if (data.thumbnail) {
                document.getElementById('imageBox').classList.add('has-image');
                document.getElementById('imagePreview').src = `/storage/${data.thumbnail}`;
            } else {
                document.getElementById('imageBox').classList.remove('has-image');
                document.getElementById('imagePreview').src = '';
            }

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync"></i> Update Paket';
        }
    </script>
</body>
</html>