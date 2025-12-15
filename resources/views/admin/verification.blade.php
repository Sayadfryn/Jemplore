@extends('layouts.admin_layout')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-light text-gray-800 border-b pb-4 mb-4">Daftar Verifikasi Konten</h2>
        <span class="inline-flex items-center px-4 py-2 text-sm font-semibold rounded-full bg-orange-100 text-orange-800">
            {{ $submissions->count() }} Pending Items
        </span>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-6">

        @forelse($submissions as $item)
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100">
                <div class="flex justify-between items-start mb-3">
                    <h3 class="text-xl font-bold text-gray-900">
                        {{ $item->tourismObject->name ?? 'Pengajuan Baru' }}
                    </h3>
                    <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700 uppercase">
                        {{ str_replace('_', ' ', $item->submission_type) }}
                    </span>
                </div>

                <p class="text-sm text-gray-500 mb-2">
                    Diajukan oleh: <strong>{{ $item->user->name }}</strong> • {{ $item->created_at->format('d M Y, H:i') }}
                </p>

                <p class="text-gray-700 mb-4">
                    Diubah Pada:
                    @foreach(array_keys($item->payload) as $key)
                        <span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono text-gray-600">{{ $key }}</span>
                    @endforeach
                </p>

                <div class="flex space-x-3 border-t pt-4">

                    <button
                        onclick='openPreview(@json($item->payload), "{{ $item->tourismObject->name ?? "New" }}")'
                        class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 transition">
                        <i class="fas fa-eye mr-2"></i> Tinjau Perubahan
                    </button>

                    <form action="{{ route('admin.verification.approve', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure to approve?')" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-green-500 hover:bg-green-600 transition shadow-md">
                            <i class="fas fa-check mr-2"></i> Setujui
                        </button>
                    </form>

                    <button onclick="openRejectModal({{ $item->id }})" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-white bg-red-600 hover:bg-red-700 transition shadow-md">
                        <i class="fas fa-times mr-2"></i> Tolak
                    </button>
                </div>
            </div>
        @empty
            <div class="text-center py-10 bg-white rounded-xl shadow-sm">
                <p class="text-gray-500">Tidak ada pengajuan tertunda.</p>
            </div>
        @endforelse

        <div class="mt-4">
            {{ $submissions->links() }}
        </div>

    </div>

    <div id="previewModal" class="fixed inset-0 flex items-center justify-center z-[100] hidden bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl mx-4 overflow-hidden">
            <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-gray-800">Tinjau Perubahan: <span id="modalTitleDestination"></span></h3>
                <button onclick="closePreview()" class="text-gray-400 hover:text-red-500"><i class="fas fa-times"></i></button>
            </div>

            <div class="p-6 h-96 overflow-y-auto" id="modalContent">
            </div>
        </div>
    </div>

    <div id="rejectModal" class="fixed inset-0 flex items-center justify-center z-[100] hidden bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Tolak Pengajuan</h3>

            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan</label>
                    <textarea name="reason" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-red-500 focus:ring-red-500" required placeholder="e.g. Data tidak lengkap..."></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</button>
                    <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">Tolak Sekarang</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openPreview(payload, name) {
        document.getElementById('modalTitleDestination').innerText = name;

        let html = '<table class="w-full text-sm text-left text-gray-500 border border-gray-200 rounded-lg overflow-hidden">';
        html += '<thead class="text-xs text-gray-700 uppercase bg-gray-50"><tr><th class="px-6 py-3 w-1/3">Field Yang Diubah</th><th class="px-6 py-3">Isi Baru</th></tr></thead><tbody class="divide-y divide-gray-200">';

        for (const [key, value] of Object.entries(payload)) {
            let displayValue = value;

            if (['thumbnail', 'image'].includes(key) && value) {
                displayValue = `<div class="relative w-32 h-20 rounded-lg overflow-hidden border border-gray-300 shadow-sm">
                                    <img src="/storage/${value}" class="w-full h-full object-cover">
                                </div>
                                <div class="text-xs text-gray-400 mt-1">${value}</div>`;
            }

            else if (key === 'gallery' && typeof value === 'object' && value !== null) {
                displayValue = '<div class="flex gap-2 flex-wrap">';

                for (const [order, path] of Object.entries(value)) {
                    displayValue += `
                        <div class="relative w-24 h-24 rounded-lg overflow-hidden border border-gray-300 shadow-sm group">
                            <img src="/storage/${path}" class="w-full h-full object-cover">
                            <div class="absolute bottom-0 left-0 bg-black/50 text-white text-[10px] px-1 w-full text-center">
                                Img #${order}
                            </div>
                        </div>`;
                }
                displayValue += '</div>';
            }

            else if (Array.isArray(value)) {
                displayValue = value.map(item =>
                    `<span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full mr-1">${item}</span>`
                ).join('');
            }

            else if (value === null || value === '') {
                displayValue = '<span class="text-gray-400 italic">(Dikosongkan)</span>';
            }

            html += `<tr class="bg-white hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900 capitalize align-top">
                            ${key.replace(/_/g, ' ')}
                        </td>
                        <td class="px-6 py-4 align-top text-gray-700">
                            ${displayValue}
                        </td>
                     </tr>`;
        }
        html += '</tbody></table>';

        document.getElementById('modalContent').innerHTML = html;
        document.getElementById('previewModal').classList.remove('hidden');
    }

    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    function openRejectModal(id) {
        document.getElementById('rejectForm').action = `/admin/verification/${id}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
    }

    window.onclick = function(event) {
        const previewModal = document.getElementById('previewModal');
        const rejectModal = document.getElementById('rejectModal');
        if (event.target == previewModal) closePreview();
        if (event.target == rejectModal) closeRejectModal();
    }
</script>
@endsection
