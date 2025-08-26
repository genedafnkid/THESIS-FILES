<!-- Top Navigation Bar -->
<header class="w-full bg-gradient-to-r from-pink-600 to-purple-700 text-white p-4 flex justify-between items-center sticky top-0 z-50 shadow-md">
    <!-- Logo / Title -->
    <h1 class="text-2xl font-extrabold tracking-wide">Theology Classroom</h1>

    <!-- Navigation Links -->
    <nav class="flex space-x-6 font-medium">
        <a href="{{ route('dashboard') }}" class="hover:text-purple-200">📊 Dashboard</a>
        <a href="{{ route('modules.index') }}" class="hover:text-purple-200">📚 Modules</a>
        <a href="{{ route('community') }}" class="hover:text-purple-200">🤝 Community</a>
        <a href="{{ route('profile.edit') }}" class="hover:text-purple-200">⚙️ Settings</a>
    </nav>

    <!-- Logout Button -->
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
</header>
