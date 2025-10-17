<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register</title>
  <!-- Tailwind via CDN (fine for Blade views) -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-slate-100">
  <div class="flex min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-md">
      <div class="mb-6 text-center">
        <a href="<?php echo e(url('/')); ?>" class="inline-flex items-center gap-2 text-slate-700 hover:text-slate-900">
          <!-- logo placeholder -->
          <img src="<?php echo e(asset('images/BLACK SMALL LOCATOR.png')); ?>" 
        alt="Logo" 
        class="h-11 w-13 rounded-xl object-cover">
          <span class="text-xl font-semibold">Digital Theology Classroom</span>
        </a>
        <h1 class="mt-4 text-2xl font-bold text-slate-900">Create your account</h1>
        <p class="mt-1 text-sm text-slate-600">Already have one?
          <a class="font-medium text-indigo-600 hover:underline" href="<?php echo e(route('login')); ?>">Sign in</a>
        </p>
      </div>

      <?php if($errors->any()): ?>
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
          <ul class="list-inside list-disc">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>

        <div>
          <label for="firstName" class="mb-1 block text-sm font-medium text-slate-700">First Name</label>
          <input id="firstName" name="firstName" type="text" value="<?php echo e(old('firstName')); ?>" required
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          <?php $__errorArgs = ['firstName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="lastName" class="mb-1 block text-sm font-medium text-slate-700">Last Name</label>
          <input id="lastName" name="lastName" type="text" value="<?php echo e(old('lastName')); ?>" required
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          <?php $__errorArgs = ['lastName'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
          <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div x-data="{ show:false }" class="relative" x-cloak>
          <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Password</label>
          <input :type="show ? 'text' : 'password'" id="password" name="password" required
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 pr-10 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          <button type="button" @click="show = !show"
                  class="absolute right-2 top-9 rounded px-2 py-1 text-xs text-slate-600 hover:bg-slate-100">
            <span x-show="!show">Show</span><span x-show="show">Hide</span>
          </button>
          <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div>
          <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">
            Confirm password
          </label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
        </div>

        <div class="flex items-center gap-2">
          <input id="terms" name="terms" type="checkbox"
                 class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-400" />
          <label for="terms" class="text-sm text-slate-700">I agree to the terms.</label>
        </div>

        <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
          Create account
        </button>

        <div class="text-center">
          <a class="text-sm font-medium text-slate-600 hover:underline" href="<?php echo e(route('password.request')); ?>">
            Forgot your password?
          </a>
        </div>
      </form>

      <p class="mt-8 text-center text-xs text-slate-500">© <?php echo e(date('Y')); ?> Digital Theology Classroom</p>
    </div>
  </div>

  <!-- Minimal Alpine for show/hide password -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\Marc\Documents\GitHub\THESIS-FILES\thesis-app\resources\views/auth/register.blade.php ENDPATH**/ ?>