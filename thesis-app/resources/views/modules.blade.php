@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-pink-600 to-purple-700 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-extrabold mb-6 tracking-wide">Theology Classroom</h1>
        <nav class="space-y-4 font-medium">
             <a href="{{ route('dashboard') }}" class="block hover:text-purple-200">📊 Dashboard</a>
            <a href="#" class="block hover:text-purple-200">📚 Modules</a>
            <a href="{{ route('community') }}" class="block hover:text-purple-200">🤝 Community</a>
            <a href="#" class="block hover:text-purple-200">⚙️ Settings</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-xl">
                <h1 class="text-3xl font-extrabold text-purple-700 mb-2">📚 Modules & Tasks</h1>
                <p class="text-gray-600">Explore your learning materials and complete activities assigned by your instructor.</p>
            </div>
        </div>

        <!-- Module List -->
        <div class="space-y-6">
            <!-- Example Module -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-bold text-purple-700 mb-2">🧱 Module 1: Introduction to Theology</h2>
                <p class="text-gray-600 mb-4">This module covers the foundations of Christian theology, including key themes in scripture and doctrine.</p>

                <!-- Tasks -->
                <ul class="space-y-2">
                    <li class="bg-gray-50 p-4 rounded border-l-4 border-indigo-500">
                        <span class="font-semibold text-indigo-700">📄 Assignment:</span> Write a 500-word reflection on the doctrine of the Trinity.
                    </li>
                    <li class="bg-gray-50 p-4 rounded border-l-4 border-green-500">
                        <span class="font-semibold text-green-700">📝 Quiz:</span> Basic Theology Quiz #1 — 10 multiple-choice questions.
                    </li>
                </ul>
            </div>

            <!-- Add more modules below -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-bold text-purple-700 mb-2">📖 Module 2: The Old Testament</h2>
                <p class="text-gray-600 mb-4">Dive into the major books and stories of the Old Testament and understand its theological impact.</p>

                <!-- Tasks -->
                <ul class="space-y-2">
                    <li class="bg-gray-50 p-4 rounded border-l-4 border-yellow-500">
                        <span class="font-semibold text-yellow-700">📄 Assignment:</span> Analyze the Covenant with Abraham (Genesis 12–17).
                    </li>
                    <li class="bg-gray-50 p-4 rounded border-l-4 border-green-500">
                        <span class="font-semibold text-green-700">📝 Quiz:</span> Old Testament Figures Quiz — 15 questions.
                    </li>
                </ul>
            </div>
        </div>
    </main>
</div>
@endsection
