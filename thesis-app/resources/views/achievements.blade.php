@extends('layouts.app')
@section('title', 'Achievements • Digital Theology Classroom')
@section('content')


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
            <a href="{{ route('leaderboards') }}" class="rounded-xl border border-gray-200 px-4 py-2 text-sm hover:bg-gray-50">
              View Leaderboard
            </a>
            <a href="{{ route('modules.index') }}"
              class="rounded-xl bg-indigo-600 text-white px-4 py-2 text-sm hover:bg-indigo-700">
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
            <div
              class="mx-auto mb-3 h-14 w-14 rounded-2xl bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-2xl">
              ✨</div>
            <p class="text-gray-700">No badges yet. Start a module or try a game to earn your first badge!</p>
            <div class="mt-4">
              <a href="{{ route('modules.index') }}"
                class="rounded-xl bg-indigo-600 text-white px-5 py-2.5 font-semibold hover:bg-indigo-700">Explore
                Modules</a>
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
                    @if(!empty($badge->icon))
                      <img src="{{ asset('images/Badges/' . $badge->icon) }}" alt="{{ $badge->name }}"
                        class="h-20 w-20 object-contain mx-auto">
                    @else
                      <div
                        class="h-12 w-12 rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-2xl">
                        🏅
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
                    <span
                      class="inline-flex items-center rounded-lg bg-emerald-50 text-emerald-700 text-xs px-2 py-1 ring-1 ring-emerald-200">
                      +{{ $badge->points }} XP
                    </span>
                  @endif
                </div>

                @if(!empty($badge->description))
                  <p class="mt-3 text-sm text-gray-700 flex-1">{{ $badge->description }}</p>
                @endif

              
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
@endsection