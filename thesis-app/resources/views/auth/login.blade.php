<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign in • Digital Theology Classroom</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    {{-- @vite(['resources/css/app.css','resources/js/app.js']) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
                    colors: {
                        brand: {
                            50: '#f8f7ff', 100: '#efeafe', 200: '#ddd0fd', 300: '#c1a6fb',
                            400: '#a178f6', 500: '#854df0', 600: '#6f35d9', 700: '#5b29b4', 800: '#4b2392', 900: '#3e1d79',
                        }
                    },
                    boxShadow: { glow: '0 10px 30px rgba(133, 77, 240, 0.35)' },
                    backgroundImage: {
                        grid: "radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)",
                    }
                }
            }
        }
    </script>
    <style>
        .blob {
            filter: blur(38px);
            opacity: .55;
        }

        @keyframes floaty {
            0% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-10px)
            }

            100% {
                transform: translateY(0)
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-brand-50 via-white to-white antialiased">
    <!-- BACKGROUND DECOR -->
    <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
        <div
            class="absolute -top-24 -left-24 w-[34rem] h-[34rem] rounded-full bg-gradient-to-tr from-brand-300/50 to-pink-300/40 blob animate-[floaty_8s_ease-in-out_infinite]">
        </div>
        <div
            class="absolute top-1/3 -right-24 w-[30rem] h-[30rem] rounded-full bg-gradient-to-tr from-indigo-200/60 to-brand-200/60 blob animate-[floaty_10s_ease-in-out_infinite]">
        </div>
        <div class="absolute inset-0 bg-grid bg-[size:18px_18px]"></div>
    </div>

    <div class="relative flex min-h-screen">
        <!-- LEFT PANEL: brand / verse -->
        <aside
            class="hidden lg:flex lg:w-[45%] xl:w-1/2 p-10 bg-gradient-to-br from-brand-500 to-indigo-700 text-white">
            <div class="max-w-xl my-auto">
                <a href="/" class="inline-flex items-center gap-3">
                    <span
                        class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-white/15 font-black">D</span>
                    <span class="text-2xl font-extrabold">Digital Theology Classroom</span>
                </a>
                <h1 class="mt-10 text-4xl font-black leading-tight">Welcome back.</h1>
                <p class="mt-3 text-white/90">Continue your journey of learning and formation with your community.</p>
                <figure class="mt-10 bg-white/10 rounded-2xl p-6">
                    <blockquote class="text-lg leading-relaxed">“Let the word of Christ dwell in you richly, teaching
                        and admonishing one another in all wisdom…”</blockquote>
                    <figcaption class="mt-2 text-sm text-white/80">Colossians 3:16</figcaption>
                </figure>
                <div class="mt-10 grid grid-cols-3 gap-3 text-center text-sm">
                    <div class="rounded-xl bg-white/10 p-4">
                        <div class="text-2xl font-extrabold">12+</div>
                        <div class="opacity-80">Modules</div>
                    </div>
                    <div class="rounded-xl bg-white/10 p-4">
                        <div class="text-2xl font-extrabold">Weekly</div>
                        <div class="opacity-80">Mentoring</div>
                    </div>
                    <div class="rounded-xl bg-white/10 p-4">
                        <div class="text-2xl font-extrabold">Live</div>
                        <div class="opacity-80">Engagement</div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- RIGHT PANEL: form -->
        <main class="flex-1 grid place-items-center p-6">
            <div class="w-full max-w-md">
                <div class="mb-8 flex items-center justify-between">
                    <a href="/" class="lg:hidden inline-flex items-center gap-2">
                        <span
                            class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-gradient-to-br from-brand-400 to-indigo-600 text-white font-black">D</span>
                        <span class="font-extrabold">DTC</span>
                    </a>
                    <a href="{{ route('register') }}" class="ml-auto text-sm text-brand-700 hover:text-brand-800">Create
                        account</a>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3 text-sm">
                        {{ session('status') }}</div>
                @endif

                <div class="rounded-2xl border border-gray-100 bg-white/80 p-6 shadow-xl">
                    <h2 class="text-2xl font-black">Sign in</h2>
                    <p class="mt-1 text-sm text-gray-600">Use your email and password to continue.</p>

                    <form method="POST" action="{{ route('login') }}" class="mt-6 space-y-5">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                                autocapitalize="none" autocomplete="email"
                                class="mt-2 block w-full rounded-xl border-gray-300 focus:border-brand-500 focus:ring-brand-500 pl-1"
                                placeholder="you@example.com" />
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between">
                                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-xs text-brand-700 hover:text-brand-800">Forgot password?</a>
                                @endif
                            </div>
                            <div class="mt-2 relative">
                                <input id="password" name="password" type="password" required
                                    autocomplete="current-password"
                                    class="block w-full rounded-xl border-gray-200 pr-12 focus:border-brand-500 focus:ring-brand-500"
                                    placeholder="••••••••" />
                                <button type="button" id="togglePw"
                                    class="absolute inset-y-0 right-0 px-3 grid place-items-center text-gray-500 hover:text-gray-700"
                                    aria-label="Toggle password visibility">
                                    <svg id="eyeIcon" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center gap-2 text-sm">
                                <input id="remember_me" name="remember" type="checkbox"
                                    class="rounded border-gray-300 text-brand-600 focus:ring-brand-500">
                                <span>Remember me</span>
                            </label>
                            <a href="{{ route('register') }}" class="text-xs text-gray-500 hover:text-brand-700">Need an
                                account?</a>
                        </div>

                        <!-- Submit -->
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-brand-500 to-indigo-600 px-5 py-3 text-white font-semibold shadow-glow hover:shadow-lg">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.5 4.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V6.31l-7.97 7.97a.75.75 0 1 1-1.06-1.06l7.97-7.97h-2.69a.75.75 0 0 1-.75-.75Z" />
                                <path
                                    d="M6.75 5.25a.75.75 0 0 1 .75.75v11.25h11.25a.75.75 0 0 1 0 1.5H7.5a1.5 1.5 0 0 1-1.5-1.5V6a.75.75 0 0 1 .75-.75Z" />
                            </svg>
                            Sign in
                        </button>

                        <!-- Validation Summary -->
                        @if ($errors->any())
                            <div class="rounded-xl border border-red-200 bg-red-50 text-red-800 px-4 py-3 text-sm">
                                <p class="font-semibold">There were problems with your input:</p>
                                <ul class="list-disc pl-5 mt-2 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>

                    <!-- Divider -->
                    <div class="my-6 flex items-center gap-3 text-xs text-gray-400">
                        <div class="h-px flex-1 bg-gray-200"></div>
                        <span>or</span>
                        <div class="h-px flex-1 bg-gray-200"></div>
                    </div>

                    <!-- Social (optional) -->
                    <div class="grid grid-cols-1 gap-3">
                        <a href="#"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2 text-sm hover:border-brand-400/60">
                            <img alt="" class="h-5 w-5" src="https://www.svgrepo.com/show/475656/google-color.svg" />
                            Continue with Google
                        </a>
                    </div>
                </div>

                <p class="mt-6 text-center text-xs text-gray-500">By continuing, you agree to our <a
                        class="underline hover:text-brand-700" href="#">Terms</a> and <a
                        class="underline hover:text-brand-700" href="#">Privacy Policy</a>.</p>
            </div>
        </main>
    </div>

    <script>
        const toggle = document.getElementById('togglePw');
        const input = document.getElementById('password');
        const icon = document.getElementById('eyeIcon');
        if (toggle) {
            toggle.addEventListener('click', () => {
                const isPw = input.type === 'password';
                input.type = isPw ? 'text' : 'password';
                icon.innerHTML = isPw
                    ? '<path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a20.38 20.38 0 0 1 5.06-6.06M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a20.38 20.38 0 0 1-3.17 4.16M14.12 9.88A3 3 0 0 1 12 9c-1.66 0-3 1.34-3 3 0 .74.27 1.41.72 1.93"/><line x1="1" y1="1" x2="23" y2="23" />'
                    : '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8Z"/><circle cx="12" cy="12" r="3"/>'
            })
        }
    </script>
</body>

</html>