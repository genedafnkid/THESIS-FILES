<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Unity Game • Digital Theology Classroom</title>

  <!-- Tailwind via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
          colors: {
            brand: { 50: '#f8f7ff', 100: '#efeafe', 200: '#ddd0fd', 300: '#c1a6fb', 400: '#a178f6', 500: '#854df0', 600: '#6f35d9', 700: '#5b29b4', 800: '#4b2392', 900: '#3e1d79' }
          },
          boxShadow: { glow: '0 10px 30px rgba(133,77,240,.35)' },
          backgroundImage: {
            grid: 'radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)'
          }
        }
      }
    }
  </script>
  <style>
    .blob {
      filter: blur(32px);
      opacity: .6
    }
  </style>

  <script>
    // Expose current user to the game
    window.currentUser = { id: "{{ auth()->id() }}" };
  </script>
</head>

<body class="min-h-screen bg-gradient-to-b from-brand-50 via-white to-white text-gray-900 antialiased">
  <!-- Background decor -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
    <div
      class="absolute -top-24 -left-24 w-[36rem] h-[36rem] rounded-full bg-gradient-to-tr from-brand-300/50 to-pink-300/40 blob">
    </div>
    <div
      class="absolute top-1/3 -right-24 w-[32rem] h-[32rem] rounded-full bg-gradient-to-tr from-indigo-200/60 to-brand-200/60 blob">
    </div>
    <div class="absolute inset-0 bg-grid bg-[size:18px_18px]"></div>
  </div>

  <!-- Top bar -->
  <header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-white/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      <a href="{{ url('/') }}" class="flex items-center gap-2">
        <span
          class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ route('modules.index') }}" class="hover:text-brand-700">Modules</a>
        <a href="{{ route('community') }}" class="hover:text-brand-700">Community</a>
        <a href="{{ route('faith-room') }}" class="text-brand-700">Faith Room</a>
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
          <a target="_blank" rel="noopener" href="{{ asset('webgl-1/index.html') }}"
            class="underline hover:text-amber-900">Open in new tab</a>
        </div>

        <!-- Responsive 16:9 wrapper -->
        <div class="relative w-full rounded-xl overflow-hidden shadow">
          <div class="w-full h-0 pb-[56.25%] bg-gray-100" id="iframe-holder">
            <iframe id="unity-iframe" class="absolute inset-0 w-full h-full" src="{{ asset('webgl-1/index.html') }}"
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

    function sendUserIdToUnity() {
      const unityGameObjectName = "ScoreSender"; // Replace with your actual GameObject name
      if (typeof unityGameObjectName !== "undefined") {
        if (typeof unityInstance !== "undefined") {
          unityInstance.SendMessage(unityGameObjectName, "SetUserId", window.currentUser.id.toString());
          console.log("📤 Sent user ID to Unity:", window.currentUser.id);
        } else {
          console.warn("⚠️ unityInstance not yet loaded");
        }
      }
    }

    // Wait a bit after Unity loads
    setTimeout(sendUserIdToUnity, 2000);

    // Set this depending on the game being played
    const GAME_NUMBER = 1;

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
</body>

</html>