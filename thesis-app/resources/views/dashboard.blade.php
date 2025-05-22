@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white shadow-xl rounded-lg p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">🎓 Digital Theology Classroom</h1>
            <p class="text-lg text-gray-600 mb-8">Welcome to your personalized dashboard!</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Modules -->
                <div class="bg-blue-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-blue-800 mb-2">📚 Modules</h2>
                    <p class="text-gray-600">Access your lessons and theological courses.</p>
                </div>

                <!-- Progress Tracking -->
                <div class="bg-green-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-green-800 mb-2">📈 Progress</h2>
                    <p class="text-gray-600">Track your learning journey and spiritual growth.</p>
                </div>

                <!-- Community / Discussion -->
                <div class="bg-yellow-100 p-6 rounded-lg shadow hover:shadow-lg transition">
                    <h2 class="text-2xl font-semibold text-yellow-800 mb-2">🤝 Community</h2>
                    <p class="text-gray-600">Engage in discussions and join prayer groups.</p>
                </div>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 transition">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
