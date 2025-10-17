<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard • Digital Theology Classroom</title>
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
      <a href="<?php echo e(url('dashboard')); ?>" class="flex items-center gap-2">
        <img src="<?php echo e(asset('images/BLACK SMALL LOCATOR.png')); ?>" 
        alt="Logo" 
        class="h-11 w-13 rounded-xl object-cover">

        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="<?php echo e(route('modules.index')); ?>" class="hover:text-brand-700">Modules</a>
        <a href="<?php echo e(route('community')); ?>" class="hover:text-brand-700">Community</a>
        <a href="<?php echo e(route('profile.edit')); ?>" class="hover:text-brand-700">Settings</a>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
          <a href="<?php echo e(route('admin.users')); ?>" class="text-brand-700">Admin</a>
        <?php endif; ?>
      </nav>
      <div class="flex items-center gap-2">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"><?php echo csrf_field(); ?></form>
        <button
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
          Logout
        </button>
      </div>
    </div>
  </header>

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
                <div class="text-xs text-gray-500">Modules</div>
                <div class="text-2xl font-extrabold">12+</div>
              </div>
              <div class="rounded-xl bg-gray-50 px-4 py-3">
                <div class="text-xs text-gray-500">Mentoring</div>
                <div class="text-2xl font-extrabold">Weekly</div>
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
        <a href="<?php echo e(route('modules.index')); ?>" class="block group">
          <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
            <div class="bg-white p-6 rounded-2xl shadow transition group-hover:shadow-lg min-h-[150px] flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-purple-700">📚 Modules</h2>
                <p class="text-gray-600 mt-1">Access your lessons and theological courses.</p>
              </div>
              <span class="text-sm text-purple-700/80">Open →</span>
            </div>
          </div>
        </a>

        <!-- Community -->
        <a href="<?php echo e(route('community')); ?>" class="block group">
          <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
            <div class="bg-white p-6 rounded-2xl shadow transition group-hover:shadow-lg min-h-[150px] flex flex-col justify-between">
              <div>
                <h2 class="text-2xl font-bold text-purple-700">🤝 Community</h2>
                <p class="text-gray-600 mt-1">Join discussions and prayer groups with classmates.</p>
              </div>
              <span class="text-sm text-purple-700/80">Open →</span>
            </div>
          </div>
        </a>

        <!-- Progress -->
        <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-400 to-purple-500">
          <div class="bg-white p-6 rounded-2xl shadow min-h-[150px]">
            <h2 class="text-2xl font-bold text-purple-700">📈 Progress</h2>
            <p class="text-gray-600 mt-1">Track your learning journey and spiritual growth.</p>
            <div class="mt-4">
              <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                <span>Spiritual Engagement</span><span>85/100</span>
              </div>
              <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full w-[85%] bg-gradient-to-r from-emerald-400 via-brand-500 to-indigo-600"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- Student-only tile -->
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'student')): ?>
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
        <?php endif; ?>
      </div>
    </section>

    <!-- Virtual Faith Room -->
    <section class="mb-10">
      <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
        <div class="bg-white p-6 rounded-2xl shadow">
          <h3 class="text-2xl font-bold text-purple-700 mb-2">🕊️ Virtual Faith Room</h3>
          <p class="text-gray-600 mb-4">Launch the 2D interactive theology classroom to begin your immersive experience.</p>
          <a href="<?php echo e(route('faith-room')); ?>"
             class="inline-flex items-center gap-2 bg-indigo-600 text-white px-5 py-2.5 rounded-xl hover:bg-indigo-700 transition shadow">
            Enter 2D Classroom
          </a>
        </div>
      </div>
    </section>

    <!-- Flash messages -->
    <?php if(session('success')): ?>
      <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-800">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
      <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-red-800">
        <ul class="list-disc pl-5">
          <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
    <?php endif; ?>

    <!-- Announcements -->
    <?php ($announcements = $announcements ?? collect()); ?>
    <section id="announcements" class="mb-16">
      <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
        <div class="bg-white p-6 rounded-2xl shadow">
          <div class="flex items-center justify-between gap-4 mb-4">
            <h3 class="text-xl font-bold text-purple-700">📢 Recent Announcements</h3>
            <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|instructor')): ?>
              <a href="#new-announcement" class="text-sm text-purple-700 hover:underline">New post</a>
            <?php endif; ?>
          </div>

          <ul class="space-y-3">
            <?php $__empty_1 = true; $__currentLoopData = $announcements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $announcement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <li class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                <p class="text-gray-800"><?php echo e($announcement->content); ?></p>
                <div class="mt-2 flex flex-wrap items-center justify-between gap-2 text-sm text-gray-500">
                  <div>
                    <span class="font-semibold text-purple-700"><?php echo e(optional($announcement->user)->name); ?></span>
                    <span class="mx-1">•</span>
                    <span><?php echo e($announcement->created_at?->format('M d, Y')); ?></span>
                  </div>
                  <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|instructor')): ?>
                  <div class="flex items-center gap-3">
                    <a href="<?php echo e(route('announcements.edit', $announcement->id)); ?>" class="text-blue-600 hover:underline">✏️ Edit</a>
                    <form action="<?php echo e(route('announcements.destroy', $announcement->id)); ?>" method="POST"
                          onsubmit="return confirm('Delete this announcement?');">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
                    </form>
                  </div>
                  <?php endif; ?>
                </div>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <li class="text-gray-500">No announcements yet.</li>
            <?php endif; ?>
          </ul>

          <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|instructor')): ?>
          <div id="new-announcement" class="mt-6">
            <form action="<?php echo e(route('announcements.store')); ?>" method="POST" class="space-y-3">
              <?php echo csrf_field(); ?>
              <textarea name="content" rows="3"
                        class="w-full rounded-xl border border-gray-300 p-3 focus:border-brand-500 focus:ring-2 focus:ring-brand-200"
                        placeholder="Write a new announcement..."></textarea>
              <button type="submit"
                      class="inline-flex items-center gap-2 rounded-xl bg-purple-600 px-4 py-2 text-white hover:bg-purple-700">
                ➕ Post Announcement
              </button>
            </form>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="border-t bg-white/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-xs text-gray-500 flex flex-col sm:flex-row gap-3 items-center justify-between">
      <p>© <?php echo e(date('Y')); ?> Digital Theology Classroom. All rights reserved.</p>
      <p>“Let the word of Christ dwell in you richly.” — Colossians 3:16</p>
    </div>
  </footer>
</body>
</html>
<?php /**PATH C:\Users\Marc\Documents\GitHub\THESIS-FILES\thesis-app\resources\views/dashboard.blade.php ENDPATH**/ ?>