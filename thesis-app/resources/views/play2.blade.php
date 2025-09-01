@extends('layouts.app')
@section('title', 'Achievements • Digital Theology Classroom')
@section('content')
<!-- Page header -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
  <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
    <div class="bg-white rounded-2xl p-6 sm:p-8">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">🎮 Unity WebGL Activity</h1>
          <p class="mt-2 text-gray-600">Play the scenario and your score will auto-save to your account.</p>
        </div>
        <div class="flex items-center gap-2">
          <button id="btn-reload"
            class="rounded-xl border border-gray-200 px-4 py-2 text-sm hover:bg-gray-50">Reload</button>
          <button id="btn-fullscreen"
            class="rounded-xl bg-indigo-600 text-white px-4 py-2 text-sm hover:bg-indigo-700">Fullscreen</button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Content -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
    <div class="bg-white rounded-2xl p-3 sm:p-4">
      <!-- Loading / Fallback -->
      <div id="loader"
        class="mb-3 flex items-center justify-between rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-amber-800 text-sm">
        <span>Loading the game… If it takes too long, try Reload or open in a new tab.</span>
        <a target="_blank" rel="noopener" href="{{ asset('webgl-2/index.html') }}"
          class="underline hover:text-amber-900">Open in new tab</a>
      </div>

      <!-- Responsive 16:9 wrapper -->
      <div class="relative w-full rounded-xl overflow-hidden shadow">
        <div class="w-full h-0 pb-[56.25%] bg-gray-100" id="iframe-holder">
          <iframe id="unity-iframe" class="absolute inset-0 w-full h-full" src="{{ asset('webgl-2/index.html') }}"
            allow="fullscreen; gamepad" sandbox="allow-scripts allow-same-origin allow-forms allow-pointer-lock"
            referrerpolicy="no-referrer"></iframe>
        </div>
      </div>

      <!-- Hints -->
      <p class="mt-3 text-xs text-gray-500">
        Tip: Some browsers block audio until you interact. Click inside the game if you don’t hear sounds.
      </p>
    </div>
  </div>
</main>

<footer class="mt-10 mb-8 text-center text-sm text-gray-500">
  © {{ date('Y') }} Digital Theology Classroom
</footer>

<script>
  window.currentUser = {
    id: "{{ auth()->id() }}"
  };

  // Set this depending on the game being played
  const GAME_NUMBER = 2;

  window.__unitySaveScore = async function (score, meterScore = null) {
    console.log("🎯 Sending score:", score, "for user ID:", window.currentUser.id, "Game:", GAME_NUMBER, "Meter:", meterScore);

    const res = await fetch("/scores", {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content
      },
      body: JSON.stringify({
        score: score,
        user_id: window.currentUser.id,
        game_number: GAME_NUMBER,
        meter_score: meterScore
      })
    });

    const text = await res.text();
    try {
      const json = JSON.parse(text);
      console.log("✅ Saved:", json);
    } catch (e) {
      console.error("❌ Response was not JSON:", text);
    }
  };

  // UI controls
  const iframe = document.getElementById('unity-iframe');
  const loader = document.getElementById('loader');
  const btnReload = document.getElementById('btn-reload');
  const btnFullscreen = document.getElementById('btn-fullscreen');

  // Hide loader once the iframe is ready (best-effort — depends on same-origin policy)
  iframe.addEventListener('load', () => {
    loader?.classList.add('hidden');
  });

  btnReload?.addEventListener('click', () => {
    loader?.classList.remove('hidden');
    iframe.src = iframe.src; // simple reload
  });

  btnFullscreen?.addEventListener('click', async () => {
    try {
      if (iframe.requestFullscreen) await iframe.requestFullscreen();
      else if (iframe.webkitRequestFullscreen) iframe.webkitRequestFullscreen();
    } catch (e) { console.warn('Fullscreen failed:', e); }
  });

  // Optional: if the game posts messages like {type:'saveScore', score: 123}
  window.addEventListener('message', (e) => {
    try {
      const data = typeof e.data === 'string' ? JSON.parse(e.data) : e.data;
      if (data && data.type === 'saveScore' && typeof data.score === 'number') {
        window.__unitySaveScore(data.score);
      }
    } catch (_) { /* ignore */ }
  });
</script>
@endsection
