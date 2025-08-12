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
                <form action="{{ route('modules.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Title</label>
                        <input type="text" name="title" class="w-full border rounded px-3 py-2" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-semibold mb-1">Description</label>
                        <textarea name="description" rows="3" class="w-full border rounded px-3 py-2" required></textarea>
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

                    <!-- Example of tasks: you could loop $module->tasks here -->
                    <ul class="space-y-2">
                        <li class="bg-gray-50 p-4 rounded border-l-4 border-indigo-500">
                            <span class="font-semibold text-indigo-700">📄 Assignment:</span> Example task here.
                        </li>
                    </ul>
                </div>
            @empty
                <p class="text-gray-600">No modules found.</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
