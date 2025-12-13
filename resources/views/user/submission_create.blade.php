<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Manage Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>
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
            max-width: 1200px;
            margin: 0 auto;
        }

        .page-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        /* Content Editor */
        .editor-container {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
        }

        .editor-header {
            margin-bottom: 24px;
        }

        .editor-title {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            margin-bottom: 4px;
        }

        .editor-subtitle {
            font-size: 12px;
            color: #6b7280;
        }

        /* Content Blocks */
        .content-block {
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 16px;
            transition: border-color 0.2s;
        }

        .content-block:hover {
            border-color: #14b8a6;
        }

        .content-block.active {
            border-color: #14b8a6;
            background-color: #f0fdfa;
        }

        .block-header {
            display: flex;
            align-items: center;
            margin-bottom: 16px;
        }

        .drag-handle {
            color: #9ca3af;
            margin-right: 12px;
            cursor: move;
        }

        .block-icon {
            margin-right: 8px;
            color: #14b8a6;
        }

        .block-title {
            font-size: 14px;
            font-weight: 500;
            color: #111827;
        }

        .image-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            display: none;
        }
        .has-image .upload-placeholder { display: none; }
        .has-image .image-preview { display: block; }
        
        .gallery-upload-item {
            position: relative;
            background-color: #ecfeff;
            border: 1px solid #67e8f9;
            border-radius: 8px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            overflow: hidden;
        }
        .gallery-upload-item:hover { border-color: #14b8a6; }

        /* Hero Image Block */
        .hero-upload {
            background-color: #ecfeff;
            border: 1px solid #67e8f9;
            border-radius: 8px;
            height: 280px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero-upload p {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        /* Form Elements */
        .form-group {
            margin-bottom: 12px;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        textarea.form-input {
            resize: vertical;
            background-color: #f9fafb;
        }

        .form-select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            background-color: #fff;
            transition: border-color 0.2s;
            cursor: pointer;
        }
        .form-select:focus {
            outline: none;
            border-color: #14b8a6;
            box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
        }

        .form-label small {
            color: #6b7280;
            font-weight: normal;
            margin-left: 4px;
        }
        
        .tags-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-top: 8px;
        }

        .tag-option {
            cursor: pointer;
            user-select: none;
        }

        .tag-option input {
            display: none;
        }

        .tag-pill {
            display: inline-block;
            padding: 6px 14px;
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            font-size: 13px;
            color: #374151;
            transition: all 0.2s;
        }

        .tag-option:hover .tag-pill {
            background-color: #e5e7eb;
        }

        .tag-option input:checked + .tag-pill {
            background-color: #ccfbf1;
            border-color: #14b8a6;
            color: #0f766e;
            font-weight: 500;
        }
        
        .tag-option input:disabled + .tag-pill {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 16px;
        }

        .gallery-item {
            background-color: #ecfeff;
            border: 1px solid #67e8f9;
            border-radius: 8px;
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            color: #6b7280;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #14b8a6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0d9488;
        }

        .btn-secondary {
            background-color: white;
            color: #14b8a6;
            border: 1px solid #14b8a6;
        }

        .btn-secondary:hover {
            background-color: #f0fdfa;
        }

        .btn-cyan {
            background-color: #06b6d4;
            color: white;
        }

        .btn-cyan:hover {
            background-color: #0891b2;
        }

        .btn i {
            margin-right: 8px;
        }

        .button-group {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
            }

            .button-group {
                flex-direction: column;
            }
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">Owner Portal</div>
                <div class="sidebar-subtitle">Jemplore System</div>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="nav-link active"><i class="fas fa-file-alt"></i> Manage Profile</a>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('public.home') }}" class="nav-link" style="margin-bottom: 12px; color: #6b7280;"><i class="fas fa-arrow-left"></i> Back to Home</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <button class="logout-btn" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">

                @if(isset($isPending) && $isPending)
                    
                    <div class="flex flex-col items-center justify-center h-[70vh] text-center">
                        <div class="w-24 h-24 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mb-6 animate-pulse">
                            <i class="fas fa-clock text-4xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Pengajuan Sedang Diproses</h2>
                        <p class="text-gray-500 max-w-lg mb-8">
                            Halo <b>{{ Auth::user()->name }}</b>, kamu sudah mengirimkan pengajuan kepemilikan wisata. 
                            Tim Admin kami sedang memverifikasi data dan dokumen kamu. Mohon ditunggu ya!
                        </p>
                        
                        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm w-full max-w-md text-left">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-gray-400 uppercase">Status</span>
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-bold rounded-full">PENDING</span>
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $submission->payload['name'] ?? 'Wisata Kamu' }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Diajukan pada: {{ $submission->created_at->format('d M Y, H:i') }}</p>
                        </div>

                        <a href="{{ route('public.home') }}" class="mt-8 text-[#47b6c2] font-medium hover:underline">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Beranda
                        </a>
                    </div>

                @else

                <h1 class="page-title">Manage Profile</h1>

                <form action="{{ route('submission.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="editor-container">
                        <div class="editor-header">
                            <div class="editor-title">Content Editor</div>
                            <div class="editor-subtitle">Add information about your tourism object.</div>
                        </div>

                        <div class="content-block active">
                            <div class="block-header">
                                <i class="fas fa-grip-vertical drag-handle"></i>
                                <i class="far fa-image block-icon"></i>
                                <span class="block-title">Hero Image (Thumbnail)</span>
                            </div>
                            
                            <div class="hero-upload relative" onclick="document.getElementById('heroInput').click()">
                                
                                <div class="upload-placeholder flex flex-col items-center">
                                    <p>Click to upload or change image</p>
                                    <span class="btn btn-primary pointer-events-none">Select Image</span>
                                </div>

                                <img src="" 
                                     id="heroPreview" class="image-preview w-full h-full object-cover absolute inset-0">
                                
                                <input type="file" name="thumbnail" id="heroInput" class="hidden" accept="image/*" onchange="previewImage(this, 'heroPreview')">
                            </div>
                        </div>

                        <div class="content-block">
                            <div class="block-header">
                                <i class="fas fa-file-contract block-icon"></i>
                                <span class="block-title">Verification Document</span>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bukti Kepemilikan / Surat Izin Usaha</label>
                                <div class="p-4 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 text-center">
                                    <input type="file" name="proof_document" required class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-teal-50 file:text-teal-700
                                    hover:file:bg-teal-100
                                    "/>
                                    <p class="text-xs text-gray-500 mt-2">Upload PDF, JPG, or PNG (Max 5MB). Dokumen ini hanya untuk verifikasi admin.</p>
                                </div>
                            </div>
                        </div>

                        <div class="content-block">
                            <div class="block-header">
                                <i class="fas fa-grip-vertical drag-handle"></i>
                                <i class="fas fa-info-circle block-icon"></i>
                                <span class="block-title">General Information</span>
                            </div>
                            
                            <div class="form-group">
                                <label class="form-label">Tourism Name</label>
                                <input type="text" name="name" class="form-input" value="">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Address / Location</label>
                                <input type="text" name="address" class="form-input" placeholder="e.g. Jl. Raya Sidomulyo, Kec. Pronojiwo, Lumajang" required>
                            </div>

                            <div class="form-group mt-4">
                                <label class="form-label flex justify-between items-center">
                                    Pin Location on Map
                                    <span class="text-xs text-[#47b6c2] font-normal">*Drag marker to adjust location</span>
                                </label>
                                
                                <div id="map" class="w-full h-[300px] rounded-xl border border-gray-300 z-0"></div>

                                <input type="hidden" name="latitude" id="lat_input">
                                <input type="hidden" name="longitude" id="lng_input">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select w-full p-2 border rounded">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tags <small id="tag-counter">(0/3)</small></label>
                                    <div class="tags-wrapper flex flex-wrap gap-2">
                                        @foreach($tags as $tag)
                                            <label class="tag-option cursor-pointer">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden">
                                                <span class="tag-pill px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">{{ $tag->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Entry Fee (Tiket Masuk)</label>
                                    <input type="text" name="ticket_price" class="form-input" placeholder="Rp 10.000" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">WhatsApp Number (Contact Person)</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-2.5 text-gray-500 font-medium">+62</span>
                                        <input type="number" name="contact_number" class="form-input pl-12" placeholder="81234567890" required>
                                    </div>
                                    <small class="text-xs text-gray-500">Masukkan angka saja, tanpa 0 di depan.</small>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Opening Time</label>
                                    <input type="time" name="opening_hours" class="form-input" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Closing Time</label>
                                    <input type="time" name="closing_hours" class="form-input" value="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="content-block">
                            <div class="block-header">
                                <i class="fas fa-grip-vertical drag-handle"></i>
                                <i class="far fa-images block-icon"></i>
                                <span class="block-title">Photo Gallery (Max 3)</span>
                            </div>
                            
                            <div class="gallery-grid grid grid-cols-1 md:grid-cols-3 gap-4">
                                @for($i = 0; $i < 3; $i++)
                                    
                                    <div class="gallery-upload-item relative" onclick="document.getElementById('galleryInput{{ $i }}').click()">
                                        
                                        <div class="upload-placeholder text-center p-4">
                                            <i class="fas fa-plus text-gray-400 text-2xl mb-2"></i>
                                            <p class="text-xs text-gray-500">Image {{ $i + 1 }}</p>
                                        </div>

                                        <img src="" 
                                             id="galleryPreview{{ $i }}" class="image-preview absolute inset-0 w-full h-full object-cover">
                                        
                                        <input type="file" name="gallery[{{ $i + 1 }}]" id="galleryInput{{ $i }}" class="hidden" accept="image/*" onchange="previewImage(this, 'galleryPreview{{ $i }}')">
                                    </div>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-500 mt-2">*Click box to upload/change image.</p>
                        </div>

                        <div class="button-group flex justify-end gap-3 mt-6">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-cyan">
                                <i class="fas fa-paper-plane"></i>
                                Submit for Approval
                            </button>
                        </div>
                    </div>
                </form>
                
                @endif
            </div>
        </main>
    </div>

    <script>
        function confirmLogout() {
            if (confirm('Apakah Anda yakin ingin logout?')) {
                document.getElementById('logout-form').submit();
            }
        }

        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            const parent = input.parentElement;

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    parent.classList.add('has-image'); 
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        const tagCheckboxes = document.querySelectorAll('input[name="tags[]"]');
        const tagCounter = document.getElementById('tag-counter');

        function updateTagCounter() {
            const checkedCount = document.querySelectorAll('input[name="tags[]"]:checked').length;
            tagCounter.innerText = `(${checkedCount}/3)`;
            
            if (checkedCount >= 3) {
                tagCheckboxes.forEach(box => {
                    if (!box.checked) {
                        box.disabled = true;
                        box.parentElement.classList.add('opacity-50', 'cursor-not-allowed');
                    }
                });
            } else {
                tagCheckboxes.forEach(box => {
                    box.disabled = false;
                    box.parentElement.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            }
        }

        tagCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateTagCounter);
        });
        
        updateTagCounter();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var defaultLat = -8.1724; 
            var defaultLng = 113.7007;

            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            function updateInput(lat, lng) {
                document.getElementById('lat_input').value = lat;
                document.getElementById('lng_input').value = lng;
            }

            updateInput(defaultLat, defaultLng);

            marker.on('dragend', function (e) {
                var position = marker.getLatLng();
                updateInput(position.lat, position.lng);
                map.panTo(position);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInput(e.latlng.lat, e.latlng.lng);
                map.panTo(e.latlng);
            });
        });
    </script>
</body>
</html>