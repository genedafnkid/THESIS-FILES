@extends('layouts.app')
@section('title', 'Leaderboards • Digital Theology Classroom')
@section('content')

  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-indigo-400 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">🏁 Leaderboards</h1>
            <p class="mt-2 text-gray-600">Top players by game and time period.</p>
          </div>
          <form method="GET" action="{{ route('leaderboards') }}" class="flex flex-wrap gap-3">
            {{-- Game Selector --}}
            <div class="relative">
              <select name="game"
                class="appearance-none rounded-xl border border-gray-300 bg-white py-2 pl-3 pr-10 text-sm font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 hover:border-gray-400">
                <option value="1" @selected($game == '1')>🎮 Game 1 — Conflict</option>
                <option value="2" @selected($game == '2')>🧭 Game 2 — Integrity</option>
                <option value="3" @selected($game == '3')>🚀 Game 3 — Leadership</option>
              </select>
              <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                ▼
              </span>
            </div>

            {{-- Period Selector --}}
            <div class="relative">
              <select name="period"
                class="appearance-none rounded-xl border border-gray-300 bg-white py-2 pl-3 pr-10 text-sm font-medium text-gray-700 shadow-sm focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 hover:border-gray-400">
                <option value="all" @selected($period == 'all')>🌍 All time ({{ $counts['all'] }})</option>
                <option value="month" @selected($period == 'month')>📅 This month ({{ $counts['month'] }})</option>
                <option value="week" @selected($period == 'week')>📆 This week ({{ $counts['week'] }})</option>
                <option value="day" @selected($period == 'day')>⏳ Today ({{ $counts['day'] }})</option>
              </select>
              <span class="pointer-events-none absolute inset-y-0 right-3 flex items-center text-gray-500">
                ▼
              </span>
            </div>

            <button
              class="rounded-xl bg-indigo-600 text-white px-5 py-2 font-semibold shadow hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
              Apply
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    @if($leaders->isEmpty())
      <div class="p-[2px] rounded-2xl bg-gradient-to-r from-indigo-300 to-brand-300">
        <div class="bg-white rounded-2xl p-8 text-center">
          <div
            class="mx-auto mb-3 h-14 w-14 rounded-2xl bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-2xl">
            🌱</div>
          <p class="text-gray-700">No scores yet for this filter. Be the first to set a record!</p>
        </div>
      </div>
    @else
      <div class="overflow-hidden rounded-2xl border border-gray-100">
        @php
          function user_avatar_url($user)
          {
            if (!$user)
              return asset('images/default-avatar.webp');

            if (!empty($user->profile_picture)) {
              return Storage::url($user->profile_picture);
            }

            return asset('images/default-avatar.webp');
          }
        @endphp


        <table class="min-w-full divide-y divide-gray-100">
          <thead class="bg-gray-50">
            <tr class="text-xs uppercase tracking-wider text-gray-500">
              <th class="px-4 py-3 text-left">Rank</th>
              <th class="px-4 py-3 text-left">Player</th>
              <th class="px-4 py-3 text-right">Quiz (/{{ $QUIZ_MAX ?? 5 }})</th>
              <th class="px-4 py-3 text-right">Meter (/{{ $METER_MAX ?? 100 }})</th>
              <th class="px-4 py-3 text-right">Final %</th>
              <th class="px-4 py-3 text-right">When</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 bg-white">
            @foreach($leaders as $i => $row)
              @php
                $user = $row->user;
                $avatarUrl = user_avatar_url($user);
                $name = $user->name ?? ('User ' . $row->user_id);

                // compute final if you didn't do it in SQL
                $quizMax = $QUIZ_MAX ?? 5;
                $meterMax = $METER_MAX ?? 100;
                $quizPct = $quizMax > 0 ? ($row->score / $quizMax) * 100 : 0;
                $meterPct = $meterMax > 0 ? ($row->meter_score / $meterMax) * 100 : 0;
                $finalPct = round(($quizPct * 0.5) + ($meterPct * 0.5), 2);
              @endphp
              <tr>
                <td class="px-4 py-3 text-sm font-semibold text-purple-700">#{{ $i + 1 }}</td>

                <td class="px-4 py-3 text-sm">
                  <div class="flex items-center gap-3">
                    @if($avatarUrl)
                      <img src="{{ $avatarUrl }}" alt="{{ $name }}"
                        class="h-9 w-9 rounded-full ring-1 ring-gray-200 object-cover">
                    @else
                      <div
                        class="h-9 w-9 rounded-full bg-gradient-to-br from-brand-400 to-indigo-600 grid place-content-center text-white text-sm font-bold">
                        {{ strtoupper(mb_substr($name, 0, 1)) }}
                      </div>
                    @endif
                    <span>{{ $name }}</span>
                  </div>
                </td>

                <td class="px-4 py-3 text-sm text-right">
                  {{ (int) $row->score }} <span class="text-gray-400">/ {{ $quizMax }}</span>
                </td>

                <td class="px-4 py-3 text-sm text-right">
                  {{ (int) $row->meter_score }} <span class="text-gray-400">/ {{ $meterMax }}</span>
                </td>

                <td class="px-4 py-3 text-sm text-right font-semibold">
                  {{-- if you computed in SQL use $row->final_percent --}}
                  {{ isset($row->final_percent) ? number_format($row->final_percent, 2) : number_format($finalPct, 2) }}%
                </td>

                <td class="px-4 py-3 text-xs text-right text-gray-500">
                  {{ $row->created_at->diffForHumans() }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </main>
@endsection