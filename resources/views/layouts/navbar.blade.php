<header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-white/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <!-- Logo -->
        <a href="{{ url('dashboard') }}" class="flex items-center gap-2">
            <img src="{{ asset('images/BLACK SMALL LOCATOR.png') }}" alt="Logo"
                class="h-11 w-13 rounded-xl object-cover">
            <span class="font-extrabold tracking-tight text-lg sm:text-xl"></span>
        </a>

        <!-- Navbar -->
        <nav class="hidden md:flex items-center gap-6 text-sm font-medium relative">
            <!-- Dropdown for Modules -->
            <div
                class="relative group before:absolute before:left-0 before:top-full before:h-2 before:w-40 before:content-['']">
                <button class="hover:text-brand-700 flex items-center gap-1">
                    Modules
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div class="absolute left-0 top-full z-50 w-40 rounded-xl bg-white shadow-lg border
           opacity-0 invisible group-hover:opacity-100 group-hover:visible
           transition duration-150 ease-out">
                    <a href="{{ route('modules.index') }}" class="block px-4 py-2 hover:bg-gray-100">Tasks</a>
                    <a href="{{ route('faith-room') }}" class="block px-4 py-2 hover:bg-gray-100">Game</a>
                    <a href="{{ route('achievements') }}" class="block px-4 py-2 hover:bg-gray-100">Achievements</a>
                </div>
            </div>


            <a href="{{ route('community') }}" class="hover:text-brand-700">Community</a>
            <a href="{{ route('profile.edit') }}" class="hover:text-brand-700">Settings</a>
            @role('admin')
            <a href="{{ route('admin.users') }}" class="text-brand-700">Admin</a>
            @endrole
        </nav>

        <!-- Logout -->
        <div class="flex items-center gap-2">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
                Logout
            </button>
        </div>
    </div>
</header>