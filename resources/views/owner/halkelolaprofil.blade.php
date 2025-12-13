<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Portal - Manage Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""/>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
        crossorigin=""></script>

    <style>
        /* ... (Style lama kamu biarin aja, copy dari file sebelumnya) ... */
        /* Biar cepet aku skip CSS-nya karena sama persis */
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
        .page-title { font-size: 24px; font-weight: 600; margin-bottom: 24px; }
        .editor-container { background: white; border: 1px solid #e5e7eb; border-radius: 12px; padding: 24px; }
        .editor-header { margin-bottom: 24px; }
        .editor-title { font-size: 14px; font-weight: 500; color: #111827; margin-bottom: 4px; }
        .editor-subtitle { font-size: 12px; color: #6b7280; }
        .content-block { border: 2px solid #e5e7eb; border-radius: 8px; padding: 24px; margin-bottom: 16px; transition: border-color 0.2s; }
        .content-block.active { border-color: #14b8a6; background-color: #f0fdfa; }
        .block-header { display: flex; align-items: center; margin-bottom: 16px; }
        .drag-handle { color: #9ca3af; margin-right: 12px; cursor: move; }
        .block-icon { margin-right: 8px; color: #14b8a6; }
        .block-title { font-size: 14px; font-weight: 500; color: #111827; }
        .form-group { margin-bottom: 12px; }
        .form-input, .form-select { width: 100%; padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 14px; transition: border-color 0.2s; }
        .form-input:focus { outline: none; border-color: #14b8a6; box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1); }
        .btn { display: inline-flex; align-items: center; padding: 10px 20px; font-size: 14px; font-weight: 500; border-radius: 8px; border: none; cursor: pointer; transition: all 0.2s; text-decoration: none; }
        .btn-primary { background-color: #14b8a6; color: white; }
        .btn-secondary { background-color: white; color: #14b8a6; border: 1px solid #14b8a6; }
        .hero-upload { background-color: #ecfeff; border: 1px solid #67e8f9; border-radius: 8px; height: 280px; display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; }
        .image-preview { width: 100%; height: 100%; object-fit: cover; border-radius: 8px; display: none; }
        .has-image .upload-placeholder { display: none; }
        .has-image .image-preview { display: block; }
        .gallery-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
        .gallery-upload-item { position: relative; background-color: #ecfeff; border: 1px solid #67e8f9; border-radius: 8px; height: 140px; display: flex; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; }
        .tag-pill { display: inline-block; padding: 6px 14px; background-color: #f3f4f6; border: 1px solid #e5e7eb; border-radius: 20px; font-size: 13px; color: #374151; transition: all 0.2s; }
        .tag-option input:checked + .tag-pill { background-color: #ccfbf1; border-color: #14b8a6; color: #0f766e; font-weight: 500; }
        .tag-option input:disabled + .tag-pill { opacity: 0.5; cursor: not-allowed; }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-title">Owner Portal</div>
                <div class="sidebar-subtitle">Jemplore System</div>
            </div>
            <nav class="sidebar-nav">
                <a href="{{ route('owner.dashboard') }}" class="nav-link"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="#" class="nav-link active"><i class="fas fa-file-alt"></i> Manage Profile</a>
                <a href="{{ route('owner.events.manage') }}" class="nav-link"><i class="far fa-calendar"></i> Manage Events</a>
                <a href="{{ route('owner.culinary.manage') }}" class="nav-link"><i class="fas fa-utensils"></i> Manage Culinary</a>
                <a href="{{ route('owner.reports.performance') }}" class="nav-link"><i class="fas fa-chart-bar"></i> Performance</a>
                <a href="{{ route('owner.submission.status') }}" class="nav-link"><i class="far fa-file-alt"></i> Submissions</a>
            </nav>
            <div class="sidebar-footer">
                <a href="{{ route('public.home') }}" class="nav-link" style="margin-bottom: 12px; color: #6b7280;"><i class="fas fa-arrow-left"></i> Back to Home</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                <button class="logout-btn" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </div>
        </aside>

        <main class="main-content">
            <div class="content-wrapper">
                <h1 class="page-title">Manage Profile</h1>

                <form action="{{ route('owner.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="editor-container">
                        <div class="editor-header">
                            <div class="editor-title">Content Editor</div>
                            <div class="editor-subtitle">Update information about your tourism object.</div>
                        </div>

                        <div class="content-block active">
                            <div class="block-header">
                                <i class="fas fa-grip-vertical drag-handle"></i>
                                <i class="far fa-image block-icon"></i>
                                <span class="block-title">Hero Image (Thumbnail)</span>
                            </div>
                            <div class="hero-upload relative {{ $wisata->thumbnail ? 'has-image' : '' }}" onclick="document.getElementById('heroInput').click()">
                                <div class="upload-placeholder flex flex-col items-center">
                                    <p>Click to upload or change image</p>
                                    <span class="btn btn-primary pointer-events-none">Select Image</span>
                                </div>
                                <img src="{{ $wisata->thumbnail ? asset('storage/' . $wisata->thumbnail) : '' }}" 
                                     id="heroPreview" class="image-preview w-full h-full object-cover absolute inset-0">
                                <input type="file" name="thumbnail" id="heroInput" class="hidden" accept="image/*" onchange="previewImage(this, 'heroPreview')">
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
                                <input type="text" name="name" class="form-input" value="{{ old('name', $wisata->name) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Location Address</label>
                                <input type="text" name="address" class="form-input" value="{{ old('address', $wisata->address) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="form-label">WhatsApp Number (Contact Person)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-2.5 text-gray-500 font-medium">+62</span>
                                    <input type="number" name="contact_number" class="form-input pl-12" placeholder="81234567890" value="{{ old('contact_number', $wisata->contact_number ? substr($wisata->contact_number, 2) : '') }}" required>
                                </div>
                                <small style="font-size: 12px; color: #6b7280;">Masukkan angka saja, tanpa 0 di depan.</small>
                            </div>

                            <div class="form-group mt-4 mb-6">
                                <label class="form-label flex justify-between items-center">
                                    Pin Location on Map
                                    <span style="font-size: 12px; color: #14b8a6; font-weight: normal;">*Drag marker to adjust location</span>
                                </label>
                                
                                <div id="map" style="width: 100%; height: 300px; border-radius: 12px; border: 1px solid #d1d5db; z-index: 0;"></div>

                                <input type="hidden" name="latitude" id="lat_input" value="{{ old('latitude', $wisata->latitude) }}">
                                <input type="hidden" name="longitude" id="lng_input" value="{{ old('longitude', $wisata->longitude) }}">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" class="form-select w-full p-2 border rounded">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $wisata->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">Tags <small id="tag-counter">(0/3)</small></label>
                                    <div class="tags-wrapper flex flex-wrap gap-2">
                                        @foreach($tags as $tag)
                                            <label class="tag-option cursor-pointer">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden" {{ $wisata->tags->contains($tag->id) ? 'checked' : '' }}>
                                                <span class="tag-pill px-3 py-1 bg-gray-100 rounded-full text-sm hover:bg-gray-200 transition">{{ $tag->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                <div class="form-group">
                                    <label class="form-label">Entry Fee (Tiket Masuk)</label>
                                    <input type="text" name="ticket_price" class="form-input" value="{{ old('ticket_price', $wisata->ticket_price) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Opening Time</label>
                                    <input type="time" name="opening_hours" class="form-input" value="{{ old('opening_hours', $wisata->opening_hours) }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Closing Time</label>
                                    <input type="time" name="closing_hours" class="form-input" value="{{ old('closing_hours', $wisata->closing_hours) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-input" rows="4">{{ old('description', $wisata->description) }}</textarea>
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
                                    @php
                                        $existingImage = $wisata->images->where('sort_order', $i + 1)->first();
                                    @endphp
                                    
                                    <div class="gallery-upload-item relative {{ $existingImage ? 'has-image' : '' }}" onclick="document.getElementById('galleryInput{{ $i }}').click()">
                                        <div class="upload-placeholder text-center p-4">
                                            <i class="fas fa-plus text-gray-400 text-2xl mb-2"></i>
                                            <p class="text-xs text-gray-500">Image {{ $i + 1 }}</p>
                                        </div>
                                        <img src="{{ $existingImage ? asset('storage/' . $existingImage->image_path) : '' }}" 
                                             id="galleryPreview{{ $i }}" class="image-preview absolute inset-0 w-full h-full object-cover">
                                        <input type="file" name="gallery[{{ $i + 1 }}]" id="galleryInput{{ $i }}" class="hidden" accept="image/*" onchange="previewImage(this, 'galleryPreview{{ $i }}')">
                                    </div>
                                @endfor
                            </div>
                            <p class="text-xs text-gray-500 mt-2">*Click box to upload/change image.</p>
                        </div>

                        <div class="button-group flex justify-end gap-3 mt-6">
                            <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                                Submit for Approval
                            </button>
                        </div>
                    </div>
                </form>
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
        tagCheckboxes.forEach(checkbox => { checkbox.addEventListener('change', updateTagCounter); });
        updateTagCounter();
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil data dari database kalau ada (Fitur Edit), kalau ga ada default Jember
            var savedLat = {{ $wisata->latitude ?? -8.1724 }};
            var savedLng = {{ $wisata->longitude ?? 113.7007 }};

            var map = L.map('map').setView([savedLat, savedLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            var marker = L.marker([savedLat, savedLng], {
                draggable: true
            }).addTo(map);

            function updateInput(lat, lng) {
                document.getElementById('lat_input').value = lat;
                document.getElementById('lng_input').value = lng;
            }

            // Set nilai awal input hidden
            updateInput(savedLat, savedLng);

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