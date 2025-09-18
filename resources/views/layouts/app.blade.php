<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- Dynamic page title --}}
  <title>@yield('title', config('app.name', 'Digital Theology Classroom'))</title>

  {{-- Fonts --}}

  {{-- Tailwind (CDN, if you’re not fully on Vite) --}}
  @vite(entrypoints: ['resources/js/app.js'])
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
