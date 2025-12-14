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

        .main-content { flex: 1; padding: 32px; overflow-y: auto; }
        .content-wrapper { max-width: 1200px; margin: 0 auto; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-title { font-size: 24px; font-weight: 600; }

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
        .btn i { margin-right: 8px; }

        .image-upload-box {
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            padding: 32px;
            text-align: center;
            cursor: pointer;
            background-color: #f9fafb;
            transition: all 0.2s;
        }
        .image-upload-box:hover { border-color: #14b8a6; background-color: #f0fdfa; }
        .upload-icon { font-size: 24px; color: #9ca3af; margin-bottom: 8px; }
        .upload-text { font-size: 14px; color: #6b7280; }

        .price-type-switch {
            display: flex;
            gap: 16px;
            margin-bottom: 12px;
        }
        .radio-label {
            display: flex;
            align-items: center;
            font-size: 14px;
            cursor: pointer;
        }
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
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link active">
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
                    <h1 class="page-title">Kelola Kuliner</h1>
                    <button class="btn btn-primary" onclick="toggleForm()">
                        <i class="fas fa-plus"></i>
                        Tambah Kuliner Baru
                    </button>
                </div>

                <div class="form-container" id="culinaryForm">
                    <h2 class="form-title">Tambah/Edit Item Kuliner</h2>

                    <form>
                        <div class="form-group">
                            <label class="form-label">Foto Kuliner</label>
                            <div class="image-upload-box">
                                <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                <div class="upload-text">Click to upload image</div>
                                <input type="file" style="display: none;">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Nama Kuliner</label>
                                <input type="text" class="form-input" placeholder="e.g., Nasi Pecel Pincuk">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Rating Terkini (Read-only)</label>
                                <input type="text" class="form-input" value="New Item (No Ratings)" disabled>
                                <small style="color: #6b7280; font-size: 12px;">*Rating is generated from user reviews</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label">Kategori Utama (Pilih 1)</label>
                                <select class="form-select">
                                    <option>Pilih Kategori</option>
                                    <option>Traditional</option>
                                    <option>Modern</option>
                                    <option>Snack</option>
                                    <option>Beverage</option>
                                    <option>Spicy</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Kategori Tambahan (Maksimal 3)</label>
                                <input type="text" class="form-input" placeholder="e.g., Sweet, Hot, Breakfast">
                                <small style="color: #6b7280; font-size: 12px;">Gunakan koma sebagai pemisah</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Konfigurasi Harga</label>

                            <div class="price-type-switch">
                                <label class="radio-label">
                                    <input type="radio" name="priceType" value="single" checked onchange="togglePriceInput()">
                                    Harga Tetap
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="priceType" value="range" onchange="togglePriceInput()">
                                    Rentang Harga
                                </label>
                            </div>

                            <div id="singlePriceInput">
                                <input type="number" class="form-input" placeholder="e.g., 15000">
                            </div>

                            <div id="rangePriceInput" class="form-row" style="display: none;">
                                <input type="number" class="form-input" placeholder="Min Price (e.g., 10000)">
                                <input type="number" class="form-input" placeholder="Max Price (e.g., 25000)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Tentang (Deskripsi)</label>
                            <textarea class="form-textarea" rows="4" placeholder="Deskripsikan rasa, bahan, dan lainnya . . ."></textarea>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Waktu Terbaik Menikmati</label>
                            <select class="form-select">
                                <option>Tiap Saat</option>
                                <option>Breakfast (Pagi)</option>
                                <option>Makan Siang (Siang)</option>
                                <option>Makan Malam (Malam)</option>
                                <option>Musim Hujan</option>
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

                    <div class="culinary-item">
                        <img src="https://via.placeholder.com/80" alt="Food" class="culinary-img">
                        <div class="culinary-info">
                            <div style="display: flex; justify-content: space-between;">
                                <div class="culinary-name">Nasi Jagung Khas Tumpak</div>
                                <span class="rating-badge"><i class="fas fa-star"></i> 4.8 (120)</span>
                            </div>
                            <div class="culinary-meta" style="margin-bottom: 8px;">
                                <span><i class="fas fa-tag"></i> Rp 15.000</span>
                                <span><i class="far fa-clock"></i> Best at: Breakfast</span>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <span class="tag-pill">Traditional</span>
                                <span class="tag-pill">Spicy</span>
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-secondary" style="padding: 8px;"><i class="fas fa-edit" style="margin:0"></i></button>
                            <button class="btn btn-secondary" style="padding: 8px; color: #ef4444; border-color: #ef4444;"><i class="fas fa-trash" style="margin:0"></i></button>
                        </div>
                    </div>

                    <div class="culinary-item">
                        <img src="https://via.placeholder.com/80" alt="Drink" class="culinary-img">
                        <div class="culinary-info">
                            <div style="display: flex; justify-content: space-between;">
                                <div class="culinary-name">Wedang Jahe Merah</div>
                                <span class="rating-badge"><i class="fas fa-star"></i> 4.5 (85)</span>
                            </div>
                            <div class="culinary-meta" style="margin-bottom: 8px;">
                                <span><i class="fas fa-tags"></i> Rp 5.000 - Rp 10.000</span>
                                <span><i class="far fa-clock"></i> Best at: Rainy Season</span>
                            </div>
                            <div style="display: flex; gap: 8px;">
                                <span class="tag-pill">Beverage</span>
                                <span class="tag-pill">Warm</span>
                            </div>
                        </div>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-secondary" style="padding: 8px;"><i class="fas fa-edit" style="margin:0"></i></button>
                            <button class="btn btn-secondary" style="padding: 8px; color: #ef4444; border-color: #ef4444;"><i class="fas fa-trash" style="margin:0"></i></button>
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

        function togglePriceInput() {
            const type = document.querySelector('input[name="priceType"]:checked').value;
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

        function toggleForm() {
            const form = document.getElementById('culinaryForm');
            if (form.style.display === 'none') {
                form.style.display = 'block';
                form.scrollIntoView({ behavior: 'smooth' });
            } else {
                form.style.display = 'none';
            }
        }

    </script>
</body>
</html>
