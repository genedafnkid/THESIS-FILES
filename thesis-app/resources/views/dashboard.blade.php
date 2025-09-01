@extends('layouts.app')
@section('title', 'Achievements • Digital Theology Classroom')
@section('content')

<!-- Page container -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  <!-- Hero header -->
  <section class="mb-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white rounded-2xl p-8 shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
          <div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-purple-700">🎓 Digital Theology Classroom</h1>
            <p class="mt-1 text-lg text-gray-600">Welcome to your personalized dashboard!</p>
          </div>
          <div class="grid grid-cols-3 gap-3 text-center">
            <div class="rounded-xl bg-gray-50 px-4 py-3">
              <div class="text-xs text-gray-500">Gamified Contents</div>
              <div class="text-2xl font-extrabold">3</div>
            </div>
            <div class="rounded-xl bg-gray-50 px-4 py-3">
              <div class="text-xs text-gray-500">Badges to Earn</div>
              <div class="text-2xl font-extrabold">16</div>
            </div>
            <div class="rounded-xl bg-gray-50 px-4 py-3">
              <div class="text-xs text-gray-500">Engagement</div>
              <div class="text-2xl font-extrabold">Live</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Quick actions -->
  <section class="mb-10">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Modules -->
      <a href="{{ route('modules.index') }}" class="block group">
        <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
          <div
            class="bg-white p-6 rounded-2xl shadow transition group-hover:shadow-lg min-h-[150px] flex flex-col justify-between">
            <div>
              <h2 class="text-2xl font-bold text-purple-700">📚 Modules</h2>
              <p class="text-gray-600 mt-1">Access your lessons and theological courses.</p>
            </div>
            <span class="text-sm text-purple-700/80">Open →</span>
          </div>
        </div>
      </a>

      <!-- Community -->
      <a href="{{ route('community') }}" class="block group">
        <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
          <div
            class="bg-white p-6 rounded-2xl shadow transition group-hover:shadow-lg min-h-[150px] flex flex-col justify-between">
            <div>
              <h2 class="text-2xl font-bold text-purple-700">🤝 Community</h2>
              <p class="text-gray-600 mt-1">Join discussions and prayer groups with classmates.</p>
            </div>
            <span class="text-sm text-purple-700/80">Open →</span>
          </div>
        </div>
      </a>

      <!-- Progress -->

      <!-- Student-only tile -->
      @role('student|admin')
      <div class="md:col-span-3">
        <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
          <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-2xl font-bold text-purple-700">🎯 Student Progress</h2>
            <p class="text-gray-600 mt-1">Your personal milestones and XP.</p>
            <div class="mt-4 grid sm:grid-cols-3 gap-4">
              <div class="rounded-xl bg-gray-50 p-4">
                <div class="text-xs text-gray-500">Completed Modules</div>
                <div class="text-2xl font-extrabold">4</div>
              </div>
              <div class="rounded-xl bg-gray-50 p-4">
                <div class="text-xs text-gray-500">Quizzes Passed</div>
                <div class="text-2xl font-extrabold">9</div>
              </div>
              <div class="rounded-xl bg-gray-50 p-4">
                <div class="text-xs text-gray-500">Consistency Streak</div>
                <div class="text-2xl font-extrabold">12d</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endrole
    </div>
  </section>

  <section class="mb-10">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white p-6 rounded-2xl shadow">
        <h3 class="text-2xl font-bold text-purple-700 mb-2">Game Room</h3>
        <p class="text-gray-600 mb-4">Launch the 2D interactive theology classroom to begin your immersive experience.
        </p>
        <a href="{{ route('faith-room') }}"
          class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition shadow">
          Enter 2D Game Room
        </a>
      </div>
    </div>
  </section>

  <!-- Flash messages -->
  @if (session('success'))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
      {{ session('success') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
      <ul class="list-disc pl-5">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Announcements -->
  @php($announcements = $announcements ?? collect())
  <section id="announcements" class="mb-16">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white p-6 rounded-2xl shadow">
        <div class="flex items-center justify-between gap-4 mb-4">
          <h3 class="text-xl font-bold text-purple-700">📢 Recent Announcements</h3>
          @role('admin|instructor')
          <a href="#new-announcement" class="text-sm text-purple-700 hover:underline">New post</a>
          @endrole
        </div>

        <ul class="space-y-3">
          @forelse($announcements as $announcement)
            <li class="bg-gray-50 p-4 rounded-xl border border-gray-100">
              <p class="text-gray-800">{{ $announcement->content }}</p>
              <div class="mt-2 flex flex-wrap items-center justify-between gap-2 text-sm text-gray-500">
                <div>
                  <span class="font-semibold text-purple-700">{{ optional($announcement->user)->name }}</span>
                  <span class="mx-1">•</span>
                  <span>{{ $announcement->created_at?->format('M d, Y') }}</span>
                </div>
                @role('admin|instructor')
                <div class="flex items-center gap-3">
                  <a href="{{ route('announcements.edit', $announcement->id) }}" class="text-blue-600 hover:underline">✏️
                    Edit</a>
                  <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                    onsubmit="return confirm('Delete this announcement?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
                  </form>
                </div>
                @endrole
              </div>
            </li>
          @empty
            <li class="text-gray-500">No announcements yet.</li>
          @endforelse
        </ul>

        @role('admin|instructor')
        <div id="new-announcement" class="mt-6">
          <form action="{{ route('announcements.store') }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="content" rows="3"
              class="w-full rounded-xl border border-gray-300 p-3 focus:border-brand-500 focus:ring-2 focus:ring-brand-200"
              placeholder="Write a new announcement..."></textarea>
            <button type="submit"
              class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
              ➕ Post Announcement
            </button>
          </form>
        </div>
        @endrole
      </div>
    </div>
  </section>

</main>
@endsection