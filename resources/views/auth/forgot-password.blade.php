<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Forgot Password</title>
  @vite(entrypoints: ['resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-100 via-white to-slate-100">
  <div class="flex min-h-screen items-center justify-center p-6">
    <div class="w-full max-w-md">
      <div class="mb-6 text-center">
        <a href="{{ url('/') }}" class="inline-flex items-center gap-2 text-slate-700 hover:text-slate-900">
          <span class="inline-block h-10 w-10 rounded-xl bg-slate-800"></span>
          <span class="text-xl font-semibold">Digital Theology Classroom</span>
        </a>
        <h1 class="mt-4 text-2xl font-bold text-slate-900">Forgot your password?</h1>
        <p class="mt-1 text-sm text-slate-600">
          Enter your email and we’ll send you a reset link.
        </p>
      </div>

      @if (session('status'))
        <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-sm text-emerald-800">
          {{ session('status') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
          <ul class="list-inside list-disc">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf
        <div>
          <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                 class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
          @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
          Email Password Reset Link
        </button>

        <div class="flex items-center justify-between text-sm">
          <a href="{{ route('login') }}" class="font-medium text-slate-600 hover:underline">Back to login</a>
          <a href="{{ route('register') }}" class="font-medium text-slate-600 hover:underline">Create account</a>
        </div>
      </form>

      <p class="mt-8 text-center text-xs text-slate-500">© {{ date('Y') }} Digital Theology Classroom</p>
    </div>
  </div>
</body>
</html>
