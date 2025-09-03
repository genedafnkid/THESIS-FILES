@extends('layouts.app')
@section('title', 'Achievements • Digital Theology Classroom')
@section('content')

  <!-- Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    <!-- Header -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">Game Room</h1>
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
              <img src="{{ asset('images/thumbnail-1.png') }}" alt="Conflict Resolution"
                   class="w-full h-full object-cover group-hover:scale-105 duration-300">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 1: Conflict Resolution</h3>
            <p class="text-xs text-gray-500">Practice peacemaking through scenario choices.</p>
          </div>

          <!-- Game 2 -->
          <div class="group">
            <a href="{{ url('/play2') }}" class="block aspect-video rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
              <img src="{{ asset('images/thumbnail-2.png') }}" alt="Integrity at Work"
                   class="w-full h-full object-cover group-hover:scale-105 duration-300">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 2: Integrity at Work</h3>
            <p class="text-xs text-gray-500">Navigate ethical dilemmas with biblical wisdom.</p>
          </div>

          <div class="group">
            <a href="{{ url('/play3') }}" class="block aspect-video rounded-2xl overflow-hidden shadow hover:shadow-lg transition">
              <img src="{{ asset('images/thumbnail-3.png') }}" alt="Integrity at Work"
                   class="w-full h-full object-cover group-hover:scale-105 duration-300">
            </a>
            <h3 class="mt-2 text-sm font-semibold text-gray-800">Game 3: Leadership in Space</h3>
            <p class="text-xs text-gray-500">Lead a stranded crew through crisis, conflict, and survival.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Tips / Safety -->
    <section class="p-[2px] rounded-2xl bg-gradient-to-r from-indigo-300 to-brand-300">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-lg font-bold text-purple-700">How to make the most of Game Room</h2>
        <ul class="mt-3 text-sm text-gray-700 list-disc pl-5 space-y-1">
          <li>Use headphones for immersive audio cues and scripture narrations.</li>
          <li>Reflect after each scenario—journal entries strengthen formation.</li>
        </ul>
      </div>
    </section>
  </main>
@endsection
