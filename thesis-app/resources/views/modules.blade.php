<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modules & Tasks • Digital Theology Classroom</title>
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
      <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
       <img src="{{ asset('images/BLACK SMALL LOCATOR.png') }}" 
        alt="Logo" 
        class="h-11 w-13 rounded-xl object-cover">
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ route('modules.index') }}" class="text-brand-700 font-semibold">Modules</a>
        <a href="{{ route('community') }}" class="hover:text-brand-700">Community</a>
        <a href="{{ route('profile.edit') }}" class="hover:text-brand-700">Settings</a>
        @role('admin')
          <a href="{{ route('admin.users') }}" class="text-brand-700">Admin</a>
        @endrole
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

  <!-- Header block -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-6 sm:p-8 flex items-start justify-between gap-6">
        <div>
          <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">📚 Modules & Tasks</h1>
          <p class="mt-2 text-gray-600">Explore your learning materials and complete activities assigned by your instructor.</p>
        </div>
        <a href="#list" class="hidden sm:inline-flex rounded-xl border border-gray-200 px-4 py-2 text-sm font-medium hover:bg-gray-50">Jump to list</a>
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
        <form action="{{ route('modules.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          @csrf
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
            <input type="text" name="title" class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500" required>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500" required></textarea>
          </div>
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-1">Upload File (optional)</label>
            <input type="file" name="file" class="w-full rounded-xl border-gray-300 px-3 py-2">
            <p class="text-xs text-gray-500 mt-1">Accepted: PDF, DOCX, PPTX, images, etc.</p>
          </div>
          <div class="flex items-end">
            <button type="submit" class="inline-flex rounded-xl bg-gradient-to-r from-green-500 to-emerald-600 text-white px-5 py-2.5 font-semibold shadow hover:shadow-lg">
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
              <button
                type="button"
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
              <form action="{{ route('modules.update', $module->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @csrf @method('PUT')
                <div class="sm:col-span-2">
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                  <input type="text" name="title" value="{{ $module->title }}"
                         class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500" required>
                </div>
                <div class="sm:col-span-2">
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                  <textarea name="description" rows="3" class="w-full rounded-xl border-gray-300 px-3 py-2 focus:border-brand-500 focus:ring-brand-500" required>{{ $module->description }}</textarea>
                </div>
                <div>
                  <label class="block text-sm font-semibold text-gray-700 mb-1">Replace File (optional)</label>
                  <input type="file" name="file" class="w-full rounded-xl border-gray-300 px-3 py-2">
                  @if($module->file_path)
                    <p class="text-xs text-gray-500 mt-1">Current: {{ basename($module->file_path) }}</p>
                  @endif
                </div>
                <div class="flex items-end">
                  <button type="submit" class="rounded-xl bg-blue-600 text-white px-5 py-2.5 font-semibold hover:bg-blue-700">
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

  <footer class="mt-10 mb-8 text-center text-sm text-gray-500">
    © {{ date('Y') }} Digital Theology Classroom
  </footer>
</body>
</html>
