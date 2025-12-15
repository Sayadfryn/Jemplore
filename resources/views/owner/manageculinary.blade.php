<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Kelola Kuliner</title>
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

        .form-container, .card-container { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; margin-bottom: 32px; }
        .form-title { font-size: 16px; font-weight: 600; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-size: 14px; font-weight: 500; color: #111827; margin-bottom: 8px; }

        .form-input, .form-select, .form-textarea { width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; background-color: #f9fafb; transition: border-color 0.2s; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1); }
        .form-input:disabled { background-color: #e5e7eb; color: #6b7280; cursor: not-allowed; }

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
        .upload-icon { font-size: 24px; color: #9ca3af; margin-bottom: 8px; }
        .upload-text { font-size: 14px; color: #6b7280; }

        .price-type-switch { display: flex; gap: 16px; margin-bottom: 12px; }
        .radio-label { display: flex; align-items: center; font-size: 14px; cursor: pointer; }
        .radio-label input { margin-right: 8px; accent-color: #14b8a6; }

        .culinary-item {
            display: flex;
            gap: 16px;
            padding: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            margin-bottom: 16px;
            background: white;
            align-items: center;
        }
        .culinary-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            background-color: #f3f4f6;
        }
        .culinary-info { flex: 1; }
        .culinary-name { font-weight: 600; color: #111827; margin-bottom: 4px; }
        .culinary-meta { font-size: 13px; color: #6b7280; display: flex; gap: 12px; align-items: center; }
        .rating-badge {
            background-color: #fef3c7; color: #92400e;
            padding: 2px 8px; border-radius: 4px; font-weight: 600; font-size: 12px;
            display: flex; align-items: center; gap: 4px;
        }
        .tag-pill {
            background-color: #ccfbf1; color: #0f766e;
            padding: 2px 8px; border-radius: 99px; font-size: 11px;
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

        @media (max-width: 768px) {
            .form-row { grid-template-columns: 1fr; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 16px; }
            .culinary-item { flex-direction: column; align-items: flex-start; }
            .culinary-img { width: 100%; height: 160px; }
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
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link active">
                    <i class="fas fa-utensils"></i>
                    Kelola Kuliner
                </a>
                <a href="{{ route('owner.packages.manage') }}" class="nav-link">
                    <i class="fas fa-box-open"></i>
                     Kelola Paket
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
                    <h1 class="page-title">Kelola Kuliner</h1>
                    <button class="btn btn-primary" onclick="toggleForm()">
                        <i class="fas fa-plus"></i>
                        Tambah Kuliner Baru
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

                <div class="form-container" id="culinaryForm" style="display: none;">
                    <h2 class="form-title">Tambah Item Kuliner</h2>

                    <form action="{{ route('owner.culinary.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Foto Kuliner</label>
                            <div class="image-upload-box" id="imageBox" onclick="document.getElementById('imageInput').click()">
                                <div class="upload-placeholder">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <div class="upload-text">Click to upload image</div>
                                </div>
                                <img id="imagePreview" class="image-preview">
                                <input type="file" name="image" id="imageInput" style="display: none;" accept="image/*" onchange="previewImage(this)">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Kuliner</label>
                                <input type="text" name="name" class="form-input" placeholder="e.g., Nasi Pecel Pincuk" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kategori Utama (Pilih 1)</label>
                                <select name="primary_tag" class="form-select" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Traditional">Traditional</option>
                                    <option value="Modern">Modern</option>
                                    <option value="Snack">Snack</option>
                                    <option value="Beverage">Beverage</option>
                                    <option value="Spicy">Spicy</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Kategori Tambahan (Maksimal 3)</label>
                            <input type="text" name="secondary_tags" class="form-input" placeholder="e.g., Sweet, Hot, Breakfast">
                            <small style="color: #6b7280; font-size: 12px;">Gunakan koma sebagai pemisah</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfigurasi Harga</label>
                            <div class="price-type-switch">
                                <label class="radio-label">
                                    <input type="radio" name="price_type" value="single" checked onchange="togglePriceInput()">
                                    Harga Tetap
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="price_type" value="range" onchange="togglePriceInput()">
                                    Rentang Harga
                                </label>
                            </div>

                            <div id="singlePriceInput">
                                <input type="number" name="price_single" class="form-input" placeholder="e.g., 15000">
                            </div>

                            <div id="rangePriceInput" class="form-row" style="display: none;">
                                <input type="number" name="price_min" class="form-input" placeholder="Min Price (e.g., 10000)">
                                <input type="number" name="price_max" class="form-input" placeholder="Max Price (e.g., 25000)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tentang (Deskripsi)</label>
                            <textarea name="description" class="form-textarea" rows="4" placeholder="Deskripsikan rasa, bahan, dan lainnya . . ."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Waktu Terbaik Menikmati</label>
                            <select name="best_at" class="form-select">
                                <option value="Tiap Saat">Tiap Saat</option>
                                <option value="Breakfast">Breakfast (Pagi)</option>
                                <option value="Lunch">Makan Siang (Siang)</option>
                                <option value="Dinner">Makan Malam (Malam)</option>
                                <option value="Rainy Season">Musim Hujan</option>
                            </select>
                        </div>

                        <div style="display: flex; gap: 12px; justify-content: flex-end;">
                            <button type="button" class="btn btn-secondary" onclick="toggleForm()">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Kuliner
                            </button>
                        </div>
                    </form>
                </div>

                <div class="card-container">
                    <h2 class="form-title">Menu Kuliner yang Ada</h2>

                    @forelse($culinaries as $culinary)
                        <div class="culinary-item">
                            <img src="{{ $culinary->image ? asset('storage/' . $culinary->image) : 'https://via.placeholder.com/80' }}" alt="{{ $culinary->name }}" class="culinary-img">
                            <div class="culinary-info">
                                <div style="display: flex; justify-content: space-between;">
                                    <div class="culinary-name">{{ $culinary->name }}</div>
                                    @if($culinary->rating > 0)
                                        <span class="rating-badge">
                                            <i class="fas fa-star"></i> {{ number_format($culinary->rating, 1) }} ({{ $culinary->total_reviews }})
                                        </span>
                                    @else
                                        <span class="rating-badge" style="background-color: #f3f4f6; color: #6b7280;">
                                            <i class="far fa-star"></i> Belum Ada Rating
                                        </span>
                                    @endif
                                </div>
                                <div class="culinary-meta" style="margin-bottom: 8px;">
                                    @if($culinary->price_type === 'single')
                                        <span><i class="fas fa-tag"></i> Rp {{ number_format($culinary->price, 0, ',', '.') }}</span>
                                    @else
                                        <span><i class="fas fa-tags"></i> Rp {{ number_format($culinary->min_price, 0, ',', '.') }} - Rp {{ number_format($culinary->max_price, 0, ',', '.') }}</span>
                                    @endif
                                    <span><i class="far fa-clock"></i> Best at: {{ $culinary->best_at ?? 'Tiap Saat' }}</span>
                                </div>
                                <div style="display: flex; gap: 8px;">
                                    <span class="tag-pill">{{ $culinary->primary_tag }}</span>
                                    @if($culinary->secondary_tags)
                                        @foreach($culinary->secondary_tags as $tag)
                                            <span class="tag-pill">{{ $tag }}</span>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <button class="btn btn-secondary" style="padding: 8px;" onclick="editCulinary({{ $culinary }})">
                                    <i class="fas fa-edit" style="margin:0"></i>
                                </button>
                                <form action="{{ route('owner.culinary.delete', $culinary->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="padding: 8px;" onclick="return confirm('Yakin ingin menghapus item ini?')">
                                        <i class="fas fa-trash" style="margin:0"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-utensils"></i>
                            <p>Belum ada menu kuliner. Mulai tambahkan item pertama Anda!</p>
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

        function togglePriceInput() {
            const type = document.querySelector('input[name="price_type"]:checked').value;
            const singleInput = document.getElementById('singlePriceInput');
            const rangeInput = document.getElementById('rangePriceInput');

            if (type === 'single') {
                singleInput.style.display = 'block';
                rangeInput.style.display = 'none';
            } else {
                singleInput.style.display = 'none';
                rangeInput.style.display = 'grid';
            }
        }

        // function toggleForm() {
        //     const form = document.getElementById('culinaryForm');
        //     if (form.style.display === 'none') {
        //         form.style.display = 'block';
        //         form.scrollIntoView({ behavior: 'smooth' });
        //     } else {
        //         form.style.display = 'none';
        //     }
        // }

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

        let isEditing = false;

        function resetForm() {
            isEditing = false;
            document.getElementById('culinaryForm').style.display = 'none';
            document.querySelector('.form-title').innerText = 'Tambah Item Kuliner';
            
            const form = document.querySelector('form');
            form.reset();
            form.action = "{{ route('owner.culinary.store') }}";
            
            const methodInput = form.querySelector('input[name="_method"]');
            if (methodInput) methodInput.remove();

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-save"></i> Simpan Kuliner';
            
            document.getElementById('imageBox').classList.remove('has-image');
            document.getElementById('imagePreview').src = '';
        }

        function toggleForm() {
            const formDiv = document.getElementById('culinaryForm');
            if (formDiv.style.display === 'none' || isEditing) {
                if(isEditing) resetForm();
                formDiv.style.display = 'block';
                formDiv.scrollIntoView({ behavior: 'smooth' });
            } else {
                formDiv.style.display = 'none';
            }
        }

        function editCulinary(data) {
            isEditing = true;
            const formDiv = document.getElementById('culinaryForm');
            const form = formDiv.querySelector('form');
            
            document.querySelector('.form-title').innerText = 'Edit Kuliner: ' + data.name;
            formDiv.style.display = 'block';
            form.action = `/owner/culinary/${data.id}`;
            formDiv.scrollIntoView({ behavior: 'smooth' });

            if (!form.querySelector('input[name="_method"]')) {
                const hiddenMethod = document.createElement('input');
                hiddenMethod.type = 'hidden';
                hiddenMethod.name = '_method';
                hiddenMethod.value = 'PUT';
                form.prepend(hiddenMethod);
            }

            form.querySelector('input[name="name"]').value = data.name;
            form.querySelector('select[name="primary_tag"]').value = data.primary_tag;
            
            if(Array.isArray(data.secondary_tags)) {
                form.querySelector('input[name="secondary_tags"]').value = data.secondary_tags.join(', ');
            } else if (data.secondary_tags) {
                form.querySelector('input[name="secondary_tags"]').value = data.secondary_tags;
            }

            form.querySelector('textarea[name="description"]').value = data.description || '';
            form.querySelector('select[name="best_at"]').value = data.best_at || 'Tiap Saat';

            const radios = form.querySelectorAll('input[name="price_type"]');
            if (data.price_type === 'single') {
                radios[0].checked = true;
                togglePriceInput();
                form.querySelector('input[name="price_single"]').value = Math.floor(data.price);
            } else {
                radios[1].checked = true;
                togglePriceInput();
                form.querySelector('input[name="price_min"]').value = Math.floor(data.min_price);
                form.querySelector('input[name="price_max"]').value = Math.floor(data.max_price);
            }

            if (data.image) {
                document.getElementById('imageBox').classList.add('has-image');
                document.getElementById('imagePreview').src = `/storage/${data.image}`;
            }

            form.querySelector('button[type="submit"]').innerHTML = '<i class="fas fa-sync"></i> Update Kuliner';
        }
    </script>
</body>
</html>
