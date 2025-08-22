@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-pink-600 to-purple-700 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-extrabold mb-6 tracking-wide">Theology Classroom</h1>
        <nav class="space-y-4 font-medium">
            <a href="#" class="block hover:text-purple-200">📊 Dashboard</a>
            <a href="{{ route('modules.index') }}" class="block hover:text-purple-200">📚 Modules</a>
            <a href="{{ route('community') }}" class="block hover:text-purple-200">🤝 Community</a>
            <a href="#" class="block hover:text-purple-200">⚙️ Settings</a>
        </nav>
    </aside>


    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header -->
        <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-8">
            <div class="bg-white rounded-xl p-8 shadow-xl">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-extrabold text-purple-700 mb-2">🎓 Digital Theology Classroom</h1>
                        <p class="text-lg text-gray-600">Welcome to your personalized dashboard!</p>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="bg-indigo-600 text-white font-semibold py-2 px-4 rounded hover:bg-indigo-700 transition">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- 📚 Modules (clickable) -->
            <a href="{{ route('modules.index') }}" class="block h-full">
                <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-400 to-purple-500 h-full">
                    <div
                        class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition h-full min-h-[160px] flex flex-col justify-center">
                        <h2 class="text-2xl font-semibold text-purple-700 mb-2">📚 Modules</h2>
                        <p class="text-gray-600">Access your lessons and theological courses.</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('modules.index') }}" class="block h-full">
                <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-400 to-purple-500 h-full">
                    <div
                        class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition h-full min-h-[160px] flex flex-col justify-center">
                        <h2 class="text-2xl font-semibold text-purple-700 mb-2">🤝 Community</h2>
                        <p class="text-gray-600">Join discussions and prayer groups with classmates.</p>
                    </div>
                </div>
            </a>

            <!-- 📈 Progress (everyone) -->
            <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-400 to-purple-500 h-full">
                <div
                    class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition h-full min-h-[160px] flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold text-purple-700 mb-2">📈 Progress</h2>
                    <p class="text-gray-600">Track your learning journey and spiritual growth.</p>
                </div>
            </div>

            <!-- 🎯 Student Progress (Student Only) -->
            @role('student')
            <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-400 to-purple-500 h-full">
                <div
                    class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition h-full min-h-[160px] flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold text-purple-700 mb-2">🎯 Student Progress</h2>
                    <p class="text-gray-600">Your personal milestones and XP.</p>
                </div>
            </div>
            @endrole
        </div>


        <!-- 🕊️ Virtual Faith Room -->
        <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-2xl font-bold text-purple-700 mb-4">🕊️ Virtual Faith Room</h3>
                <p class="text-gray-600 mb-4">Launch the 2D interactive theology classroom to begin your immersive
                    experience.</p>
                <a href="{{ route('faith-room') }}"
                    class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                    Enter 2D Classroom
                </a>
            </div>
        </div>

        <!-- 📢 Announcements (dynamic) -->
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-300 rounded text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 rounded text-red-800">
                <ul class="list-disc ml-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @php($announcements = $announcements ?? collect())
        <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-xl font-bold text-purple-700 mb-4">📢 Recent Announcements</h3>

                <ul class="space-y-2">
                    @forelse($announcements as $announcement)
                        <li class="bg-gray-50 p-4 rounded shadow text-gray-700">
                            {{ $announcement->content }}
                            <span class="block text-sm text-gray-500">
                                📅 {{ $announcement->created_at?->format('M d, Y') }}
                            </span>

                            @role('admin|instructor')
                            <div class="mt-2 flex space-x-2">
                                <a href="{{ route('announcements.edit', $announcement->id) }}"
                                    class="text-blue-600 hover:underline">✏️ Edit</a>
                                <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                                    onsubmit="return confirm('Delete this announcement?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
                                </form>
                            </div>
                            @endrole
                        </li>
                    @empty
                        <li class="text-gray-500">No announcements yet.</li>
                    @endforelse
                </ul>

                @role('admin|instructor')
                <div class="mt-4">
                    <form action="{{ route('announcements.store') }}" method="POST">
                        @csrf
                        <textarea name="content" rows="3"
                            class="w-full p-2 border rounded-lg focus:ring focus:ring-purple-300"
                            placeholder="Write a new announcement..."></textarea>
                        <button type="submit"
                            class="mt-2 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                            ➕ Post Announcement
                        </button>
                    </form>
                </div>
                @endrole
            </div>
        </div>
    </main>
</div>
@endsection