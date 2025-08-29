<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Achievements • Digital Theology Classroom</title>

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
          backgroundImage: { grid: 'radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)' }
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
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ route('modules.index') }}" class="hover:text-brand-700">Modules</a>
        <a href="{{ route('community') }}" class="hover:text-brand-700">Community</a>
        <a href="{{ route('achievements') }}" class="text-brand-700">Achievements</a>
      </nav>
      <div class="flex items-center gap-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
          Logout
        </button>
      </div>
    </div>
  </header>

  <!-- Page header -->
  @php
    $earnedCount = isset($badges) ? $badges->count() : 0;
    $totalAvailable = $totalAvailable ?? null; // optional
    $progress = $totalAvailable && $totalAvailable > 0 ? intval(($earnedCount / $totalAvailable) * 100) : null;
  @endphp

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">🏆 Achievements</h1>
            <p class="mt-2 text-gray-600">Your earned badges from modules, games, and challenges.</p>
          </div>
          <div class="flex items-center gap-2">
            <a href="#" class="rounded-xl border border-gray-200 px-4 py-2 text-sm hover:bg-gray-50">
              View Leaderboard
            </a>
            <a href="{{ route('modules.index') }}" class="rounded-xl bg-indigo-600 text-white px-4 py-2 text-sm hover:bg-indigo-700">
              Continue Learning
            </a>
          </div>
        </div>

        @if(!is_null($progress))
          <div class="mt-6">
            <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
              <span>Progress</span>
              <span>{{ $earnedCount }}/{{ $totalAvailable }} ({{ $progress }}%)</span>
            </div>
            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
              <div class="h-full" style="width: {{ $progress }}%;"
                   class="bg-gradient-to-r from-emerald-400 via-brand-500 to-indigo-600"></div>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>

  <!-- Earned badges -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-10">
    <section>
      <h2 class="sr-only">Earned Badges</h2>

      @if($earnedCount === 0)
        <div class="p-[2px] rounded-2xl bg-gradient-to-r from-indigo-300 to-brand-300">
          <div class="bg-white rounded-2xl p-8 text-center">
            <div class="mx-auto mb-3 h-14 w-14 rounded-2xl bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-2xl">✨</div>
            <p class="text-gray-700">No badges yet. Start a module or try a game to earn your first badge!</p>
            <div class="mt-4">
              <a href="{{ route('modules.index') }}" class="rounded-xl bg-indigo-600 text-white px-5 py-2.5 font-semibold hover:bg-indigo-700">Explore Modules</a>
            </div>
          </div>
        </div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          @foreach($badges as $badge)
            <article class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
              <div class="bg-white rounded-2xl p-5 h-full flex flex-col">
                <div class="flex items-start justify-between gap-3">
                  <div class="flex items-center gap-3">
                    @php
                      // expected fields: $badge->icon_url or ->icon (emoji), ->name, ->description, ->earned_at
                      $icon = $badge->icon_url ?? null;
                      $emoji = $badge->icon ?? null;
                    @endphp
                    @if($icon)
                      <img src="{{ $icon }}" alt="" class="h-12 w-12 rounded-xl object-cover ring-1 ring-gray-200">
                    @else
                      <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-2xl">
                        {{ $emoji ?? '🏅' }}
                      </div>
                    @endif
                    <div>
                      <h3 class="text-lg font-semibold text-purple-700">{{ $badge->name ?? 'Unnamed Badge' }}</h3>
                      @if(!empty($badge->category))
                        <p class="text-xs text-gray-500">{{ $badge->category }}</p>
                      @endif
                    </div>
                  </div>
                  @if(!empty($badge->points))
                    <span class="inline-flex items-center rounded-lg bg-emerald-50 text-emerald-700 text-xs px-2 py-1 ring-1 ring-emerald-200">
                      +{{ $badge->points }} XP
                    </span>
                  @endif
                </div>

                @if(!empty($badge->description))
                  <p class="mt-3 text-sm text-gray-700 flex-1">{{ $badge->description }}</p>
                @endif

                <div class="mt-4 flex items-center justify-between text-xs text-gray-500">
                  <span>Earned: {{ optional($badge->earned_at)->format('M d, Y') ?? '—' }}</span>
                  @if(!empty($badge->share_url))
                    <a href="{{ $badge->share_url }}" target="_blank" class="underline hover:text-gray-700">Share</a>
                  @endif
                </div>
              </div>
            </article>
          @endforeach
        </div>

        @if(method_exists($badges, 'links'))
          <div class="pt-6">{{ $badges->links() }}</div>
        @endif
      @endif
    </section>

    {{-- Optional: Locked/available badges preview (if you pass $availableBadges) --}}
    @isset($availableBadges)
      <section class="space-y-4">
        <h2 class="text-lg font-bold text-purple-700">🔒 Locked Badges</h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
          @foreach($availableBadges as $b)
            @php
              $earned = isset($badges) ? $badges->contains(fn($eb) => ($eb->id ?? null) === ($b->id ?? -1)) : false;
            @endphp
            @if(!$earned)
              <div class="rounded-2xl border border-dashed border-gray-200 p-4 bg-white/70">
                <div class="flex items-center gap-3">
                  @if(!empty($b->icon_url))
                    <img src="{{ $b->icon_url }}" alt="" class="h-10 w-10 rounded-lg object-cover opacity-60">
                  @else
                    <div class="h-10 w-10 rounded-lg bg-gray-200 grid place-content-center text-gray-500 text-xl">🔒</div>
                  @endif
                  <div>
                    <div class="text-sm font-semibold text-gray-700">{{ $b->name ?? 'Secret Badge' }}</div>
                    @if(!empty($b->hint))
                      <div class="text-xs text-gray-500">{{ $b->hint }}</div>
                    @endif
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        </div>
      </section>
    @endisset
  </main>

  <footer class="mt-10 mb-8 text-center text-sm text-gray-500">
    © {{ date('Y') }} Digital Theology Classroom
  </footer>
</body>
</html>
