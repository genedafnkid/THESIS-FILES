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

        <div class="p- bg-gray-100 min-h-screen">
            <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-6">
                <div class="bg-white p-6 rounded-xl shadow">
                    <h1 class="text-3xl font-extrabold text-purple-700 mb-4">🕊️ Virtual Faith Room</h1>
                    <p class="text-gray-600 mb-6">Explore your gamified theology content below.</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Game 1 -->
                        <div class="group">
                            <a href="{{ url('play1') }}"
                                class="block aspect-video border rounded-xl overflow-hidden shadow">
                                <img src="{{ asset('storage/thumbnail-1.png') }}" alt="Game 1 Thumbnail"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <h3 class="mt-2 text-sm font-medium text-gray-800">Game 1: Conflict Resolution</h3>
                        </div>

                        <!-- Game 2 -->
                        <div class="group">
                            <a href="{{ url('play2') }}"
                                class="block aspect-video border rounded-xl overflow-hidden shadow">
                                <img src="{{ asset('storage/thumbnail-2.png') }}" alt="Game 2 Thumbnail"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <h3 class="mt-2 text-sm font-medium text-gray-800">Game 2: Integrity at Work</h3>
                        </div>

                        <!-- Game 3 -->
                        <div class="group">
                            <a href="{{ url('play2') }}"
                                class="block aspect-video border rounded-xl overflow-hidden shadow">
                                <img src="{{ asset('storage/thumbnail-2.png') }}" alt="Game 2 Thumbnail"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </a>
                            <h3 class="mt-2 text-sm font-medium text-gray-800">Game 3: COMING SOON</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection