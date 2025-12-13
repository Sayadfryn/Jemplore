@extends('layouts.admin_layout')

@section('content')
    <h2 class="text-3xl font-light text-gray-800 border-b pb-4 mb-8">Master Data Management</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 h-fit">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Categories</h3>
                <button onclick="openModal('addCategoryModal')" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg text-white bg-blue-500 hover:bg-blue-600 transition shadow-md">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add
                </button>
            </div>
            
            <div class="divide-y divide-gray-200 max-h-[400px] overflow-y-auto pr-2">
                @forelse($categories as $category)
                <div class="flex justify-between items-center py-3 group hover:bg-gray-50 px-2 rounded transition">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full {{ $category->color }} border border-gray-300"></span>
                        <span class="text-gray-700 font-medium">{{ $category->name }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" class="inline-block">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Kamu benar-benar ingin menghapus tag/kategori ini?')" 
                                    class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" 
                                    title="Delete Category">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-gray-500">
                    <p>No categories available.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 h-fit">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Thematic Tags</h3>
                <button onclick="openModal('addTagModal')" class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-lg text-white bg-blue-500 hover:bg-blue-600 transition shadow-md">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Add
                </button>
            </div>
            
            <div class="divide-y divide-gray-200 max-h-[400px] overflow-y-auto pr-2">
                @forelse($tags as $tag)
                <div class="flex justify-between items-center py-3 group hover:bg-gray-50 px-2 rounded transition">
                    <span class="text-gray-700 bg-gray-100 px-3 py-1 rounded-full text-sm font-medium">{{ $tag->name }}</span>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.tag.delete', $tag->id) }}" method="POST" class="inline-block">
                            @csrf 
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this tag? All associated data will be affected.')" 
                                    class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" 
                                    title="Delete Tag">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="text-center py-6 text-gray-500">
                    <p>No tags available.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div id="addCategoryModal" class="fixed inset-0 flex items-center justify-center z-[100] hidden bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Add New Category</h3>
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Label Color (Tailwind Class)</label>
                    <select name="color" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        <option value="bg-[#47b6c2]">Teal (Default)</option>
                        <option value="bg-blue-500">Blue</option>
                        <option value="bg-green-500">Green</option>
                        <option value="bg-purple-500">Purple</option>
                        <option value="bg-orange-500">Orange</option>
                        <option value="bg-red-500">Red</option>
                    </select>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div id="addTagModal" class="fixed inset-0 flex items-center justify-center z-[100] hidden bg-black/50 backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Add New Tag</h3>
            <form action="{{ route('admin.tag.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tag Name</label>
                    <input type="text" name="name" required placeholder="e.g. Hidden Gem" class="w-full px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeModal('addTagModal')" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">Cancel</button>
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Save</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    window.onclick = function(e) {
        if (e.target.classList.contains('fixed')) {
            e.target.classList.add('hidden');
        }
    }
</script>
@endsection