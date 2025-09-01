@extends('layouts.app')
@section('title', 'Achievements • Digital Theology Classroom')
@section('content')

  <!-- Header block -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-6 sm:p-8 flex items-start justify-between gap-6">
        <div>
          <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">📚 Modules & Tasks</h1>
          <p class="mt-2 text-gray-600">Explore your learning materials and complete activities assigned by your
            instructor.</p>
        </div>
        <a href="#list"
          class="hidden sm:inline-flex rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">Jump
          to list</a>
      </div>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
    {{-- Flash messages --}}
    @if (session('success'))
      <div class="rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
        <ul class="list-disc ml-5">
          @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
      </div>
    @endif

    {{-- Create module (instructor/admin only) --}}
    @hasanyrole('instructor|admin')
    <section class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-bold text-purple-700 mb-4">➕ Add Module / Assessment</h2>
        <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data"
          class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          @csrf
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title"
              class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500" required>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3"
              class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500"
              required></textarea>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload File (optional)</label>
            <input type="file" name="file" class="w-full rounded-xl border-gray-300 px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Accepted: PDF, DOCX, PPTX, images, etc.</p>
          </div>
          <div class="flex items-end">
            <button type="submit"
              class="inline-flex rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 font-semibold shadow hover:shadow-lg">
              Save Module
            </button>
          </div>
        </form>
      </div>
    </section>
    @endhasanyrole

    <!-- Module List -->
    <section id="list" class="space-y-6">
      @forelse($modules as $module)
        <article class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
          <div class="bg-white rounded-2xl p-6 sm:p-8">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
              <div>
                <h3 class="text-2xl font-bold text-purple-700">{{ $module->title }}</h3>
                <p class="mt-1 text-gray-600">{{ $module->description }}</p>
              </div>
              <div class="flex gap-2">
                @if($module->file_path)
                  <a href="{{ asset('storage/' . $module->file_path) }}" target="_blank"
                    class="inline-flex items-center rounded-xl bg-indigo-600 text-white px-4 py-2 font-medium shadow hover:bg-indigo-700">
                    📂 View File
                  </a>
                @else
                  <span class="inline-flex items-center rounded-xl bg-gray-100 text-gray-600 px-3 py-2 text-sm">No file</span>
                @endif
              </div>
            </div>

            @hasanyrole('instructor|admin')
            <div class="mt-5 flex flex-wrap gap-3">
              <button type="button"
                onclick="document.getElementById('edit-form-{{ $module->id }}').classList.toggle('hidden')"
                class="rounded-xl bg-yellow-500 text-white px-4 py-2 font-semibold hover:bg-yellow-600">
                ✏️ Edit
              </button>
              <form action="{{ route('modules.destroy', $module->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this module?');">
                @csrf @method('DELETE')
                <button type="submit" class="rounded-xl bg-red-500 text-white px-4 py-2 font-semibold hover:bg-red-600">
                  🗑️ Delete
                </button>
              </form>
            </div>

            <!-- Hidden Edit Form -->
            <div id="edit-form-{{ $module->id }}" class="hidden mt-6 rounded-2xl border border-gray-200 bg-gray-50 p-5">
              <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @csrf @method('PUT')
                <div class="sm:col-span-2">
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                  <input type="text" name="title" value="{{ $module->title }}"
                    class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500"
                    required>
                </div>
                <div class="sm:col-span-2">
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                  <textarea name="description" rows="3"
                    class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500"
                    required>{{ $module->description }}</textarea>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Replace File (optional)</label>
                  <input type="file" name="file" class="w-full rounded-xl border-gray-300 px-3 py-2">
                  @if($module->file_path)
                    <p class="text-xs text-gray-500 mt-1">Current: {{ basename($module->file_path) }}</p>
                  @endif
                </div>
                <div class="flex items-end">
                  <button type="submit"
                    class="rounded-xl bg-blue-600 text-white px-5 py-2.5 font-semibold hover:bg-blue-700">
                    ✅ Update Module
                  </button>
                </div>
              </form>
            </div>
            @endhasanyrole
          </div>
        </article>
      @empty
        <p class="text-center text-gray-600">No modules found.</p>
      @endforelse
    </section>
  </main>
@endsection