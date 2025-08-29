<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Community • Digital Theology Classroom</title>
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
          backgroundImage: {
            grid: 'radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)'
          }
        }
      }
    }
  </script>
  <style>
    .blob{filter:blur(32px);opacity:.6}
    .modal-open{overflow:hidden}
  </style>
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
      <a href="{{ url('dashboard') }}" class="flex items-center gap-2">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="{{ route('modules.index') }}" class="hover:text-brand-700">Modules</a>
        <a href="{{ route('community') }}" class="text-brand-700">Community</a>
        <a href="{{ route('profile.edit') }}" class="hover:text-brand-700">Settings</a>
        @role('admin')
          <a href="{{ route('admin.users') }}" class="text-brand-700">Admin</a>
        @endrole
      </nav>
      <div class="flex items-center gap-2">
        <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
        <button
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
          Logout
        </button>
      </div>
    </div>
  </header>

  <!-- Page container -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    <!-- Header card -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-8">
        <h1 class="text-3xl md:text-4xl font-extrabold text-purple-700">🤝 Community Discussion Board</h1>
        <p class="text-gray-600 mt-1">Share your thoughts, ask questions, and connect with fellow students.</p>
      </div>
    </div>

    <!-- Alerts -->
    @if (session('success'))
      <div class="p-4 bg-green-100 border border-green-300 rounded-xl text-green-800">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="p-4 bg-red-100 border border-red-300 rounded-xl text-red-800">
        <ul class="list-disc ml-4">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Create Post (Admin/Instructor) -->
    @hasanyrole('admin|instructor')
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
      <div class="bg-white rounded-2xl p-6">
        <form action="{{ route('community.store') }}" method="POST" class="space-y-3">
          @csrf
          <label class="block text-sm font-medium text-purple-700">Start a discussion</label>
          <textarea name="content" rows="4" required
            class="w-full p-4 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400"
            placeholder="What’s on your mind?"></textarea>
          <div class="flex justify-end">
            <button type="submit"
              class="rounded-xl bg-indigo-600 text-white font-semibold px-6 py-2 hover:bg-indigo-700 transition">
              Post
            </button>
          </div>
        </form>
      </div>
    </div>
    @endhasanyrole

    <!-- Posts list -->
    <section class="space-y-6">
      @forelse ($posts as $post)
        <article class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-300 to-purple-400">
          <div class="bg-white rounded-2xl p-6">
            <header class="flex flex-wrap items-center justify-between gap-2 mb-3">
              <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white grid place-content-center font-bold">
                  {{ strtoupper(substr($post->user->name,0,1)) }}
                </div>
                <div>
                  <h2 class="text-purple-700 font-semibold">{{ $post->user->name }}</h2>
                  <span class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                </div>
              </div>

              @hasanyrole('admin|instructor')
              <div class="flex items-center gap-2">
                <button
                  data-edit-target="post-{{ $post->id }}"
                  class="px-3 py-1 rounded-lg bg-yellow-500 text-white text-sm hover:bg-yellow-600"
                  type="button">✏️ Edit</button>
                <form action="{{ route('community.destroy', $post->id) }}" method="POST"
                      onsubmit="return confirm('Delete this post?');">
                  @csrf @method('DELETE')
                  <button class="px-3 py-1 rounded-lg bg-red-500 text-white text-sm hover:bg-red-600" type="submit">🗑️ Delete</button>
                </form>
              </div>
              @endhasanyrole
            </header>

            <p class="text-gray-800 whitespace-pre-line">{{ $post->content }}</p>

            <!-- Reply form (everyone logged in) -->
            <div class="mt-5 border-t pt-4">
              <form action="{{ route('community.reply', $post->id) }}" method="POST" class="space-y-2">
                @csrf
                <textarea name="content" rows="2" required
                  class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-purple-400"
                  placeholder="Write a reply..."></textarea>
                <div class="flex justify-end">
                  <button class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700" type="submit">Reply</button>
                </div>
              </form>
            </div>

            <!-- Replies -->
            @if ($post->replies && $post->replies->count())
              <div class="mt-4 pl-4 border-l-2 border-gray-100 space-y-3">
                @foreach ($post->replies as $reply)
                  <div class="p-3 rounded-xl bg-gray-50">
                    <div class="flex items-center justify-between">
                      <p class="text-sm font-semibold text-purple-600">{{ $reply->user->name }}</p>
                      <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="text-sm text-gray-700 mt-1 whitespace-pre-line">{{ $reply->content }}</p>

                    @if ($reply->user_id === auth()->id())
                      <div class="flex gap-2 mt-2">
                        <button
                          data-edit-target="reply-{{ $reply->id }}"
                          class="px-2 py-1 text-xs rounded-lg bg-yellow-500 text-white hover:bg-yellow-600"
                          type="button">✏️ Edit</button>
                        <form action="{{ route('replies.destroy', $reply->id) }}" method="POST"
                              onsubmit="return confirm('Delete this reply?');">
                          @csrf @method('DELETE')
                          <button class="px-2 py-1 text-xs rounded-lg bg-red-500 text-white hover:bg-red-600" type="submit">🗑️ Delete</button>
                        </form>
                      </div>
                    @endif
                  </div>

                  <!-- Reply Edit Modal -->
                  <div id="modal-reply-{{ $reply->id }}" class="hidden fixed inset-0 z-40 bg-black/50 p-4">
                    <div class="mx-auto max-w-md rounded-2xl bg-white p-6 shadow-xl">
                      <h3 class="text-lg font-bold text-purple-700 mb-3">Edit Reply</h3>
                      <form action="{{ route('replies.update', $reply->id) }}" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <textarea name="content" rows="3" class="w-full p-3 border rounded-xl">{{ $reply->content }}</textarea>
                        <div class="flex justify-end gap-2">
                          <button type="button" data-close="#modal-reply-{{ $reply->id }}"
                                  class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300">Cancel</button>
                          <button type="submit" class="px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700">Save</button>
                        </div>
                      </form>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          </div>
        </article>

        <!-- Post Edit Modal -->
        @hasanyrole('admin|instructor')
        <div id="modal-post-{{ $post->id }}" class="hidden fixed inset-0 z-40 bg-black/50 p-4">
          <div class="mx-auto max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <h3 class="text-lg font-bold text-purple-700 mb-3">Edit Post</h3>
            <form action="{{ route('community.update', $post->id) }}" method="POST" class="space-y-3">
              @csrf @method('PUT')
              <textarea name="content" rows="4" class="w-full p-3 border rounded-xl">{{ $post->content }}</textarea>
              <div class="flex justify-end gap-2">
                <button type="button" data-close="#modal-post-{{ $post->id }}"
                        class="px-4 py-2 rounded-xl bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700">Save</button>
              </div>
            </form>
          </div>
        </div>
        @endhasanyrole

      @empty
        <p class="text-center text-gray-600">No posts yet. Start the conversation!</p>
      @endforelse
    </section>

    <!-- Pagination (if you paginate $posts) -->
    @if(method_exists($posts, 'links'))
      <div class="pt-4">{{ $posts->links() }}</div>
    @endif
  </main>

  <script>
    // Modal toggles (no Alpine needed)
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('[data-edit-target]');
      if (btn) {
        const id = btn.getAttribute('data-edit-target');
        const modal = document.getElementById('modal-' + id);
        if (modal) { modal.classList.remove('hidden'); document.documentElement.classList.add('modal-open'); }
      }
      const closeBtn = e.target.closest('[data-close]');
      if (closeBtn) {
        const sel = closeBtn.getAttribute('data-close');
        const modal = document.querySelector(sel);
        if (modal) { modal.classList.add('hidden'); document.documentElement.classList.remove('modal-open'); }
      }
      if (e.target.classList.contains('bg-black/50')) {
        e.target.classList.add('hidden'); document.documentElement.classList.remove('modal-open');
      }
    });
  </script>
</body>
</html>
