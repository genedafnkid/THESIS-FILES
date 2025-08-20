@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-pink-600 to-purple-700 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-extrabold mb-6 tracking-wide">Theology Classroom</h1>
        <nav class="space-y-4 font-medium">
            <a href="{{ route('dashboard') }}" class="block hover:text-purple-200">📊 Dashboard</a>
            <a href="{{ route('modules.index') }}" class="block hover:text-purple-200">📚 Modules</a>
            <a href="{{ route('community') }}" class="block hover:text-purple-200">🤝 Community</a>
            <a href="#" class="block hover:text-purple-200">⚙️ Settings</a>
        </nav>
    </aside>

   <!-- Main Content -->
<main class="flex-1 p-6">
    <!-- Header -->
    <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-xl flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold text-purple-700 mb-2">📚 Modules & Tasks</h1>
                <p class="text-gray-600">Explore your learning materials and complete activities assigned by your instructor.</p>
            </div>
        </div>
    </div>

    {{-- Only instructors & admins can add --}}
    @hasanyrole('instructor|admin')
        <div class="bg-white p-6 rounded-xl shadow-md mb-8">
            <h2 class="text-xl font-bold text-purple-700 mb-4">➕ Add Module / Assessment</h2>
            <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Title</label>
                    <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Description</label>
                    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" required></textarea>
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">Upload File</label>
                    <input type="file" name="file" class="w-full border rounded px-3 py-2">
                    <p class="text-sm text-gray-500 mt-1">Accepted formats: PDF, DOCX, PPTX, images, etc.</p>
                </div>
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">
                    Save Module
                </button>
            </form>
        </div>
    @endhasanyrole

    <!-- Module List -->
    <div class="space-y-6">
        @forelse($modules as $module)
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-bold text-purple-700 mb-2">{{ $module->title }}</h2>
                <p class="text-gray-600 mb-4">{{ $module->description }}</p>

                {{-- Show file if exists --}}
                @if($module->file_path)
                    <a href="{{ asset('storage/' . $module->file_path) }}" 
                       target="_blank" 
                       class="inline-block bg-indigo-500 text-white px-3 py-2 rounded hover:bg-indigo-600 transition mb-4">
                        📂 View the File
                    </a>
                @else
                    <p class="text-gray-500 italic">No file uploaded</p>
                @endif

                {{-- Edit/Delete only visible to instructor/admin --}}
                @hasanyrole('instructor|admin')
                    <div class="mt-4 flex space-x-2">
                        <!-- Toggle Edit Form Button -->
                        <button onclick="document.getElementById('edit-form-{{ $module->id }}').classList.toggle('hidden')" 
                                class="bg-yellow-500 text-white px-3 py-2 rounded hover:bg-yellow-600 transition">
                            ✏️ Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="{{ route('modules.destroy', $module->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Are you sure you want to delete this module?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="bg-red-500 text-white px-3 py-2 rounded hover:bg-red-600 transition">
                                🗑️ Delete
                            </button>
                        </form>
                    </div>

                    <!-- Hidden Edit Form -->
                    <div id="edit-form-{{ $module->id }}" class="hidden mt-4 bg-gray-50 p-4 rounded-lg border">
                        <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Title</label>
                                <input type="text" name="title" value="{{ $module->title }}" class="w-full border rounded px-3 py-2" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Description</label>
                                <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" required>{{ $module->description }}</textarea>
                            </div>
                            <div>
                                <label class="block text-gray-700 font-semibold mb-1">Replace File (optional)</label>
                                <input type="file" name="file" class="w-full border rounded px-3 py-2">
                                @if($module->file_path)
                                    <p class="text-sm text-gray-500 mt-1">Current: {{ basename($module->file_path) }}</p>
                                @endif
                            </div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                ✅ Update Module
                            </button>
                        </form>
                    </div>
                @endhasanyrole
            </div>
        @empty
            <p class="text-gray-600">No modules found.</p>
        @endforelse
    </div>
</main>
</div>
@endsection

