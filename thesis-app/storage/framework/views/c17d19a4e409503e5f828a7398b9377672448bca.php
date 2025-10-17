<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin • Approved Users</title>
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
      <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2">
        <span class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
        <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
      </a>
      <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
        <a href="<?php echo e(route('modules.index')); ?>" class="hover:text-brand-700">Modules</a>
        <a href="<?php echo e(route('community')); ?>" class="hover:text-brand-700">Community</a>
        <a href="<?php echo e(route('profile.edit')); ?>" class="text-brand-700 font-semibold">Settings</a>
        <a href="<?php echo e(route('admin.users.approved')); ?>" class="text-brand-700">Admin</a>
      </nav>
      <div class="flex items-center gap-2">
        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST"><?php echo csrf_field(); ?></form>
        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
          class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 px-4 py-2 text-white font-semibold shadow-glow hover:shadow-lg">
          Logout
        </button>
      </div>
    </div>
  </header>

  <!-- Main -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Tabs -->
    <div class="mb-6 flex flex-wrap gap-2">
      <a href="<?php echo e(route('admin.users')); ?>"
         class="px-4 py-2 rounded-xl border transition <?php if(request()->routeIs('admin.users')): ?> bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow <?php else: ?> bg-white text-gray-700 hover:border-brand-200 <?php endif; ?>">
         Pending
      </a>
      <a href="<?php echo e(route('admin.users.approved')); ?>"
         class="px-4 py-2 rounded-xl border transition <?php if(request()->routeIs('admin.users.approved')): ?> bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow <?php else: ?> bg-white text-gray-700 hover:border-brand-200 <?php endif; ?>">
         Approved
      </a>
    </div>

    <!-- Header -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 mb-6">
      <div class="bg-white rounded-2xl p-6 shadow-xl">
        <h1 class="text-3xl font-extrabold text-brand-800">✅ Approved Users</h1>
        <p class="text-gray-600 mt-1">Manage roles or move users back to pending.</p>
      </div>
    </div>

    <?php if(session('success')): ?>
      <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
        <?php echo e(session('success')); ?>

      </div>
    <?php endif; ?>

    <!-- Table -->
    <div class="overflow-hidden rounded-2xl bg-white shadow">
      <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50/80">
            <tr>
              <th class="px-6 py-3 text-left text-[11px] tracking-wide font-semibold text-gray-500 uppercase">Name</th>
              <th class="px-6 py-3 text-left text-[11px] tracking-wide font-semibold text-gray-500 uppercase">Email</th>
              <th class="px-6 py-3 text-left text-[11px] tracking-wide font-semibold text-gray-500 uppercase">Current Role(s)</th>
              <th class="px-6 py-3 text-left text-[11px] tracking-wide font-semibold text-gray-500 uppercase">Actions</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <tr class="hover:bg-brand-50/40 align-top">
                <td class="px-6 py-4 whitespace-nowrap">
                  <?php echo e($user->firstName ?? $user->name); ?> <?php echo e($user->lastName ?? ''); ?>

                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <?php echo e($user->email); ?>

                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex flex-wrap gap-2">
                    <?php echo e($user->roles->pluck('name')->map(fn($r) => ucfirst($r))->join(', ') ?: '—'); ?>

                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex flex-wrap gap-2">
                    
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(!$user->hasRole($role->name)): ?>
                        <form action="<?php echo e(route('admin.changeRole', ['id' => $user->id, 'role' => $role->name])); ?>" method="POST">
                          <?php echo csrf_field(); ?>
                          <button type="submit"
                            class="text-xs rounded-lg bg-slate-700 hover:bg-slate-800 text-white px-3 py-1">
                            Set <?php echo e(ucfirst($role->name)); ?>

                          </button>
                        </form>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <form action="<?php echo e(route('admin.revokeUser', $user->id)); ?>" method="POST" onsubmit="return confirm('Revoke this user to pending?');">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="text-xs rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1">
                        Revoke to Pending
                      </button>
                    </form>

                    
                    <form action="<?php echo e(route('admin.denyUser', $user->id)); ?>" method="POST" onsubmit="return confirm('Move this user to denied?');">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="text-xs rounded-lg bg-red-500 hover:bg-red-600 text-white px-3 py-1">
                        Deny
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <tr>
                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                  No approved users.
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>
<?php /**PATH C:\Users\Marc\Documents\GitHub\THESIS-FILES\thesis-app\resources\views/admin/users-approved.blade.php ENDPATH**/ ?>