<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Faith Room • Digital Theology Classroom</title>
  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'] },
          colors: {
            brand: {50:'#f8f7ff',100:'#efeafe',200:'#ddd0fd',300:'#c1a6fb',400:'#a178f6',500:'#854df0',600:'#6f35d9',700:'#5b29b4',800:'#4b2392',900:'#3e1d79'}
          },
          boxShadow: { glow: '0 10px 30px rgba(133,77,240,.35)' },
          backgroundImage: {
            grid: 'radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)'
          }
        }
      }
    }
  </script>
  <style>.blob{filter:blur(32px);opacity:.6}</style>
</head>
<body class="min-h-screen bg-gradient-to-b from-brand-50 via-white to-white text-gray-900 antialiased">

  <!-- Background decor -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute -top-24 -left-24 w-[36rem] h-[36rem] rounded-full bg-gradient-to-tr from-brand-300/50 to-pink-300/40 blob"></div>
    <div class="absolute top-1/3 -right-24 w-[32rem] h-[32rem] rounded-full bg-gradient-to-tr from-indigo-200/60 to-brand-200/60 blob"></div>
    <div class="absolute inset-0 bg-grid bg-[size:18px_18px]"></div>
  </div>

  <!-- Top bar -->
  <header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-white/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ route('modules.index') }}" class="hover:text-brand-700">Modules</a>
        <a href="{{ route('community') }}" class="hover:text-brand-700">Community</a>
        <a href="{{ route('faith-room') }}" class="text-brand-700">Faith Room</a>
        @role('admin')
          <a href="{{ route('admin.users') }}" class="text-brand-700">Admin</a>
        @endrole
      </nav>
      <div class="flex items-center gap-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
        <button
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
          Logout
        </button>
      </div>
    </div>
  </header>

  <!-- Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    <!-- Header -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">🕊️ Virtual Faith Room</h1>
        <p class="text-gray-600 mt-1">Gamified activities designed to nurture spiritual formation.</p>
        <div class="mt-6">
        </div>
      </div>
    </div>

    <!-- Games Grid -->
    <section class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <!-- Game 1 -->
          <div class="group">
            <a href="{{ url('/play1') }}" class="block aspect-video rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
              <img src="{{ asset('storage/thumbnail-1.png') }}" alt="Conflict Resolution"
                   class="w-full h-full object-cover group-hover:scale-105 duration-300">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 1: Conflict Resolution</h3>
            <p class="text-xs text-gray-500">Practice peacemaking through scenario choices.</p>
          </div>

          <!-- Game 2 -->
          <div class="group">
            <a href="{{ url('/play2') }}" class="block aspect-video rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
              <img src="{{ asset('storage/thumbnail-2.png') }}" alt="Integrity at Work"
                   class="w-full h-full object-cover group-hover:scale-105 duration-300">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 2: Integrity at Work</h3>
            <p class="text-xs text-gray-500">Navigate ethical dilemmas with biblical wisdom.</p>
          </div>

          <!-- Game 3 (Coming Soon) -->
          <div class="group relative">
            <a href="#" class="block aspect-video rounded-2xl overflow-hidden shadow opacity-70 pointer-events-none">
              <img src="{{ asset('storage/thumbnail-2.png') }}" alt="Coming Soon" class="w-full h-full object-cover">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 3: Coming Soon</h3>
            <span class="inline-flex mt-1 text-[10px] uppercase tracking-wide px-2 py-0.5 rounded bg-gray-100 text-gray-600">In Development</span>
          </div>
        </div>
      </div>
    </section>

    <!-- Tips / Safety -->
    <section class="p-[2px] rounded-2xl bg-gradient-to-r from-indigo-300 to-brand-300">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-lg font-bold text-purple-700">How to make the most of Faith Room</h2>
        <ul class="mt-3 text-sm text-gray-700 list-disc pl-5 space-y-1">
          <li>Use headphones for immersive audio cues and scripture narrations.</li>
          <li>Reflect after each scenario—journal entries strengthen formation.</li>
          <li>Return weekly; XP and badges unlock advanced modules.</li>
        </ul>
      </div>
    </section>
  </main>
</body>
</html>
