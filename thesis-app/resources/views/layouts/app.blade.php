<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Dynamic page title --}}
  <title>@yield('title', config('app.name', 'Digital Theology Classroom'))</title>

  {{-- Fonts --}}
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  {{-- Tailwind (CDN, if you’re not fully on Vite) --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter','ui-sans-serif','system-ui'] },
          colors: {
            brand: {
              50:'#f8f7ff',100:'#efeafe',200:'#ddd0fd',300:'#c1a6fb',
              400:'#a178f6',500:'#854df0',600:'#6f35d9',700:'#5b29b4',
              800:'#4b2392',900:'#3e1d79'
            }
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

  {{-- Vite build --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-b from-brand-50 via-white to-white text-gray-900 antialiased">
  <!-- Background decor -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute -top-24 -left-24 w-[36rem] h-[36rem] rounded-full bg-gradient-to-tr from-brand-300/50 to-pink-300/40 blob"></div>
    <div class="absolute top-1/3 -right-24 w-[32rem] h-[32rem] rounded-full bg-gradient-to-tr from-indigo-200/60 to-brand-200/60 blob"></div>
    <div class="absolute inset-0 bg-grid bg-[size:18px_18px]"></div>
  </div>

  <div class="min-h-screen">
    @include('layouts.navbar')

    {{-- Optional slot header --}}
    @if (isset($header))
      <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endif

    <!-- Page Content -->
    <main>
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-10 mb-8 text-center text-sm text-gray-500">
      © {{ date('Y') }} Digital Theology Classroom
    </footer>
  </div>
</body>
</html>
