<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Digital Theology Classroom • Welcome</title>
  <meta name="description" content="Digital Theology Classroom — AI‑enhanced e‑learning for Bible school curriculum and faith‑based formation." />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- TailwindCSS: Use ONE of the following -->
  
  <!-- Otherwise, use CDN for a drop‑in page preview: -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'ui-sans-serif', 'system-ui'] },
          colors: {
            brand: {
              50:  '#f8f7ff',
              100: '#efeafe',
              200: '#ddd0fd',
              300: '#c1a6fb',
              400: '#a178f6',
              500: '#854df0',
              600: '#6f35d9',
              700: '#5b29b4',
              800: '#4b2392',
              900: '#3e1d79',
            },
          },
          boxShadow: {
            glow: '0 10px 30px rgba(133, 77, 240, 0.35)',
          },
          backgroundImage: {
            grid: "radial-gradient(circle at 1px 1px, rgb(255 255 255 / 0.35) 1px, transparent 0)",
          }
        }
      }
    }
  </script>
  <style>
    /* Subtle animated gradient blob */
    .blob { filter: blur(32px); opacity: .6; }
    @keyframes floaty { 0% { transform: translateY(0) } 50% { transform: translateY(-10px) } 100% { transform: translateY(0) } }
  </style>
</head>
<body class="bg-gradient-to-b from-brand-50 via-white to-white text-gray-900 antialiased">
  <!-- BACKGROUND DECOR -->
  <div aria-hidden="true" class="pointer-events-none fixed inset-0 -z-10">
    <div class="absolute -top-24 -left-24 w-[36rem] h-[36rem] rounded-full bg-gradient-to-tr from-brand-300/50 to-pink-300/40 blob animate-[floaty_8s_ease-in-out_infinite]"></div>
    <div class="absolute top-1/3 -right-24 w-[32rem] h-[32rem] rounded-full bg-gradient-to-tr from-indigo-200/60 to-brand-200/60 blob animate-[floaty_10s_ease-in-out_infinite]"></div>
    <div class="absolute inset-0 bg-grid bg-[size:18px_18px]"></div>
  </div>

  <!-- NAVBAR -->
  <header class="sticky top-0 z-30 bg-white/70 backdrop-blur border-b border-white/60">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <a href="/" class="flex items-center gap-2 group">
            <img src="<?php echo e(asset('images/BLACK SMALL LOCATOR.png')); ?>" 
            alt="Logo" 
            class="h-11 w-13 rounded-xl object-cover">
          <span class="font-extrabold tracking-tight text-lg sm:text-xl">Digital Theology Classroom</span>
        </a>
        <nav class="hidden md:flex items-center gap-6 text-sm font-medium">
          <a href="#features" class="hover:text-brand-700">Features</a>
          <a href="#how" class="hover:text-brand-700">How it works</a>
          <a href="#gallery" class="hover:text-brand-700">Gallery</a>
          <a href="#faq" class="hover:text-brand-700">FAQ</a>
        </nav>
        <div class="flex items-center gap-3">
          <a href="<?php echo e(route('login')); ?>" class="hidden sm:inline-flex px-4 py-2 rounded-xl border border-gray-200 hover:border-brand-400/60 hover:text-brand-800">Log in</a>
          <a href="<?php echo e(route('register')); ?>" class="inline-flex px-4 py-2 rounded-xl bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow hover:shadow-lg">Get started</a>
        </div>
      </div>
    </div>
  </header>

  <!-- HERO -->
  <section class="relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20 pt-16">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
          <div class="inline-flex items-center gap-2 rounded-full border border-brand-300/40 bg-white/70 px-3 py-1 text-xs font-semibold text-brand-800">
            <span class="h-2 w-2 rounded-full bg-brand-500 animate-pulse"></span>
            AI‑enhanced spiritual engagement
          </div>
          <h1 class="mt-5 text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight">
            Form minds <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-indigo-700">and</span> shape hearts—online.
          </h1>
          <p class="mt-5 text-lg text-gray-600 max-w-xl">
            The Digital Theology Classroom (DTC) blends 2D interactive storytelling, live mentorship, and AI‑powered engagement metrics to support holistic theological formation.
          </p>
          <div class="mt-8 flex flex-wrap items-center gap-3">
            <a href="<?php echo e(route('modules.index')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-gray-900 text-white shadow-lg hover:translate-y-[-1px] transition">
              Enter Classroom
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M13.5 4.5a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 .75.75v4.5a.75.75 0 0 1-1.5 0V6.31l-7.97 7.97a.75.75 0 1 1-1.06-1.06l7.97-7.97h-2.69a.75.75 0 0 1-.75-.75Z"/><path d="M6.75 5.25a.75.75 0 0 1 .75.75v11.25h11.25a.75.75 0 0 1 0 1.5H7.5a1.5 1.5 0 0 1-1.5-1.5V6a.75.75 0 0 1 .75-.75Z"/></svg>
            </a>
            <a href="<?php echo e(route('community')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-white ring-1 ring-gray-200 hover:ring-brand-400/60">
              Join Community
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5"><path d="M12 13.5c2.485 0 4.5-2.015 4.5-4.5S14.485 4.5 12 4.5 7.5 6.515 7.5 9s2.015 4.5 4.5 4.5ZM3.75 19.125a8.25 8.25 0 0 1 16.5 0 .375.375 0 0 1-.375.375H4.125a.375.375 0 0 1-.375-.375Z"/></svg>
            </a>
          </div>

          <!-- QUICK STATS -->
          <dl class="mt-10 grid grid-cols-3 gap-3 max-w-xl">
            <div class="rounded-2xl bg-white/80 border border-gray-100 p-4 text-center">
              <dt class="text-xs text-gray-500">Interactive Modules</dt>
              <dd class="text-2xl font-extrabold mt-1">12+</dd>
            </div>
            <div class="rounded-2xl bg-white/80 border border-gray-100 p-4 text-center">
              <dt class="text-xs text-gray-500">Mentor Sessions</dt>
              <dd class="text-2xl font-extrabold mt-1">Weekly</dd>
            </div>
            <div class="rounded-2xl bg-white/80 border border-gray-100 p-4 text-center">
              <dt class="text-xs text-gray-500">Spiritual Meter</dt>
              <dd class="text-2xl font-extrabold mt-1">Live</dd>
            </div>
          </dl>
        </div>

        <!-- HERO GALLERY (random photos) -->
        <div class="relative">
          <div class="absolute -inset-6 -z-10 rounded-3xl bg-gradient-to-tr from-brand-200/60 to-indigo-200/60 blur-2xl"></div>
          <div class="grid grid-cols-2 gap-4">
            <img class="rounded-3xl shadow-xl object-cover h-56 w-full" src="<?php echo e(asset('images/first.jpg')); ?>" alt="Open Bible on a desk" />
            <img class="rounded-3xl shadow-xl object-cover h-72 w-full" src="<?php echo e(asset('images/second.jpg')); ?>" alt="Students discussing with laptops" />
            <img class="rounded-3xl shadow-xl object-cover h-72 w-full" src="<?php echo e(asset('images/third.jpg')); ?>" alt="Prayer hands in soft light" />
            <img class="rounded-3xl shadow-xl object-cover h-56 w-full" src="<?php echo e(asset('images/fourth.jpg')); ?>" alt="Notebook, pen, and coffee for study" />
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section id="features" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl sm:text-4xl font-black">Built for holistic formation</h2>
        <p class="mt-4 text-gray-600">DTC blends academic rigor with spiritual mentorship using practical, delightful tools.</p>
      </div>
      <div class="mt-12 grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- book icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M3 5.25A2.25 2.25 0 0 1 5.25 3h10.5A2.25 2.25 0 0 1 18 5.25V19.5a.75.75 0 0 1-1.125.65L12 17.25l-4.875 2.9A.75.75 0 0 1 6 19.5V5.25A2.25 2.25 0 0 0 3.75 3H3v2.25Z"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">2D Interactive Storytelling</h3>
          <p class="mt-2 text-sm text-gray-600">Choice‑based scenes deepen understanding through lived scenarios like conflict resolution and leadership.</p>
        </div>
        <!-- Card 2 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- heart pulse icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M11.246 3.017a.75.75 0 0 1 1.508 0l.401 4.216 2.027-1.959a.75.75 0 0 1 1.292.58l-.357 4.724 2.984-.996a.75.75 0 0 1 .947.957l-1.96 5.407a3 3 0 0 1-2.82 2.043H8.732a3 3 0 0 1-2.82-2.043L3.953 11.54a.75.75 0 0 1 .947-.956l2.984.996-.357-4.724a.75.75 0 0 1 1.292-.58l2.027 1.96.4-4.22Z"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">Spiritual Engagement Meter</h3>
          <p class="mt-2 text-sm text-gray-600">Live engagement scoring with gentle mentor alerts—augmenting, not replacing, human discipleship.</p>
          <!-- demo meter -->
          <div class="mt-4">
            <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
              <span>Today</span><span>85/100</span>
            </div>
            <div class="w-full h-2.5 bg-gray-100 rounded-full overflow-hidden">
              <div class="h-full w-[85%] bg-gradient-to-r from-emerald-400 via-brand-500 to-indigo-600"></div>
            </div>
          </div>
        </div>
        <!-- Card 3 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- chat icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M4.5 6.75A2.25 2.25 0 0 1 6.75 4.5h10.5a2.25 2.25 0 0 1 2.25 2.25v6.75A2.25 2.25 0 0 1 17.25 15H9l-4.5 4.5V6.75Z"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">Live Mentorship & Prayer</h3>
          <p class="mt-2 text-sm text-gray-600">Synchronous sessions via Zoom/Teams, integrated reflection prompts, and community prayer rooms.</p>
        </div>
        <!-- Card 4 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- journal icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M6.75 4.5A2.25 2.25 0 0 0 4.5 6.75v10.5A2.25 2.25 0 0 0 6.75 19.5h10.5a.75.75 0 0 0 .75-.75V6.75A2.25 2.25 0 0 0 15.75 4.5H6.75Zm8.25 3a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5h6Zm0 3a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5h6Zm0 3a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1 0-1.5h6Z"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">Reflective Journaling</h3>
          <p class="mt-2 text-sm text-gray-600">Guided prompts with optional AI summaries to help track growth in understanding and devotion.</p>
        </div>
        <!-- Card 5 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- layers icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 3 3 8.25 12 13.5 21 8.25 12 3Zm-9 9 9 5.25 9-5.25"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">Curriculum‑Ready</h3>
          <p class="mt-2 text-sm text-gray-600">Designed for Bible school courses and discipleship tracks—modular, measurable, reproducible.</p>
        </div>
        <!-- Card 6 -->
        <div class="group rounded-2xl border border-gray-100 p-6 bg-gradient-to-b from-white to-brand-50/40 hover:shadow-glow transition">
          <div class="h-12 w-12 grid place-items-center rounded-xl bg-gradient-to-br from-brand-500 to-indigo-600 text-white shadow-lg">
            <!-- shield icon -->
            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2.25c-3 1.875-6 2.25-9 2.25 0 6.75 3 12 9 15 6-3 9-8.25 9-15-3 0-6-.375-9-2.25Z"/></svg>
          </div>
          <h3 class="mt-4 font-bold text-lg">Privacy & Security</h3>
          <p class="mt-2 text-sm text-gray-600">Sensitive reflections are protected with encrypted storage and role‑based access.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- HOW IT WORKS -->
  <section id="how" class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
          <h2 class="text-3xl sm:text-4xl font-black">From login to lived wisdom</h2>
          <p class="mt-4 text-gray-600">A simple path that honors both scholarship and spiritual formation.</p>
          <ol class="mt-8 space-y-5">
            <li class="flex gap-4">
              <span class="h-10 w-10 shrink-0 grid place-items-center rounded-xl bg-gray-900 text-white font-bold">1</span>
              <div>
                <h3 class="font-bold">Sign in & pick a module</h3>
                <p class="text-gray-600 text-sm">Start with topics like Conflict Resolution, Leadership, or Spiritual Practices.</p>
              </div>
            </li>
            <li class="flex gap-4">
              <span class="h-10 w-10 shrink-0 grid place-items-center rounded-xl bg-gray-900 text-white font-bold">2</span>
              <div>
                <h3 class="font-bold">Engage the story</h3>
                <p class="text-gray-600 text-sm">Make choices in 2D scenes; see how wisdom shapes outcomes.</p>
              </div>
            </li>
            <li class="flex gap-4">
              <span class="h-10 w-10 shrink-0 grid place-items-center rounded-xl bg-gray-900 text-white font-bold">3</span>
              <div>
                <h3 class="font-bold">Reflect & discuss</h3>
                <p class="text-gray-600 text-sm">Post reflections, pray in groups, and join live mentor sessions.</p>
              </div>
            </li>
            <li class="flex gap-4">
              <span class="h-10 w-10 shrink-0 grid place-items-center rounded-xl bg-gray-900 text-white font-bold">4</span>
              <div>
                <h3 class="font-bold">Track growth</h3>
                <p class="text-gray-600 text-sm">View the Spiritual Engagement Meter and milestones over time.</p>
              </div>
            </li>
          </ol>
          <div class="mt-10 flex flex-wrap gap-3">
            <a href="<?php echo e(route('register')); ?>" class="inline-flex px-5 py-3 rounded-2xl bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow">Create account</a>
            <a href="#faq" class="inline-flex px-5 py-3 rounded-2xl bg-white ring-1 ring-gray-200">Read FAQ</a>
          </div>
        </div>
        <div class="relative">
          <img class="rounded-3xl shadow-2xl object-cover w-full h-[480px]" src="<?php echo e(asset('images/study.jpg')); ?>" alt="Students in a small group with Bibles and notebooks" />
          <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl border p-4 w-[260px]">
            <p class="text-xs text-gray-500">Today’s Reflection</p>
            <p class="mt-1 text-sm">“Blessed are the peacemakers…” —
              <span class="font-semibold">Matthew 5:9</span>
            </p>
            <div class="mt-2 flex items-center gap-2 text-xs">
              <span class="inline-flex h-2.5 w-2.5 rounded-full bg-emerald-500"></span>
              <span class="text-gray-600">Engagement: High</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- GALLERY -->
  <section id="gallery" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-end justify-between">
        <div>
          <h2 class="text-3xl sm:text-4xl font-black">Moments & Spaces</h2>
          <p class="mt-2 text-gray-600">Snapshots from study, prayer, and community life.</p>
        </div>
        <a href="<?php echo e(route('modules.index')); ?>" class="hidden sm:inline-flex px-4 py-2 rounded-xl bg-gray-900 text-white">Explore modules</a>
      </div>
      <div class="mt-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
        <img class="aspect-[4/5] object-cover rounded-xl" src="<?php echo e(asset('images/fifth.jpg')); ?>" alt="Candle and Bible"/>
        <img class="aspect-square object-cover rounded-xl" src="<?php echo e(asset('images/sixth.jpg')); ?>" alt="Laptop and coffee for study"/>
        <img class="aspect-[4/5] object-cover rounded-xl" src="<?php echo e(asset('images/seventh.jpg')); ?>" alt="Quiet church interior"/>
        <img class="aspect-square object-cover rounded-xl" src="<?php echo e(asset('images/eighth.jpg')); ?>" alt="Group discussion"/>
        <img class="aspect-[4/5] object-cover rounded-xl" src="<?php echo e(asset('images/ninth.jpg')); ?>" alt="Forest path for retreat"/>
        <img class="aspect-square object-cover rounded-xl" src="<?php echo e(asset('images/tenth.jpg')); ?>" alt="Hands in prayer"/>
      </div>
    </div>
  </section>

  <!-- QUOTE / TESTIMONIAL -->
  <section class="py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <figure class="bg-white/70 border border-gray-100 rounded-3xl p-8 shadow-lg">
        <blockquote class="text-2xl sm:text-3xl font-semibold leading-snug">
          “Do not be conformed to this world, but be transformed by the renewal of your mind.”
        </blockquote>
        <figcaption class="mt-4 text-sm text-gray-600">Romans 12:2</figcaption>
      </figure>
    </div>
  </section>

  <!-- FAQ -->
  <section id="faq" class="py-20 bg-white">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
      <h2 class="text-3xl sm:text-4xl font-black text-center">Frequently Asked Questions</h2>
      <div class="mt-10 grid md:grid-cols-2 gap-6">
        <div class="rounded-2xl border border-gray-100 p-6">
          <h3 class="font-bold">Is the DTC only for Bible schools?</h3>
          <p class="mt-2 text-gray-600 text-sm">It’s designed for Bible schools and church discipleship programs, but adaptable to small groups and independent study.</p>
        </div>
        <div class="rounded-2xl border border-gray-100 p-6">
          <h3 class="font-bold">How does the Spiritual Engagement Meter work?</h3>
          <p class="mt-2 text-gray-600 text-sm">It aggregates participation signals (choices, reflections, attendance) and offers gentle insights for mentors. No scores are ever public by default.</p>
        </div>
        <div class="rounded-2xl border border-gray-100 p-6">
          <h3 class="font-bold">Do I need to install anything?</h3>
          <p class="mt-2 text-gray-600 text-sm">No. DTC runs in the browser. Zoom/Teams integration is optional for live sessions.</p>
        </div>
        <div class="rounded-2xl border border-gray-100 p-6">
          <h3 class="font-bold">Is my data private?</h3>
          <p class="mt-2 text-gray-600 text-sm">Yes. Reflections are encrypted and visible only to you and your assigned mentor/admin per your program’s policy.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="border-t bg-white/70">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center gap-2">
            <img src="<?php echo e(asset('images/BLACK SMALL LOCATOR.png')); ?>" 
            alt="Logo" 
            class="h-11 w-13 rounded-xl object-cover">
            <span class="font-extrabold">Digital Theology Classroom</span>
          </div>
          <p class="mt-3 text-sm text-gray-600 max-w-sm">An e‑learning application for Bible school curriculum and faith‑based learning—where technology serves formation.</p>
        </div>
        <div class="text-sm">
          <h4 class="font-semibold">Explore</h4>
          <ul class="mt-3 space-y-2 text-gray-600">
            <li><a class="hover:text-brand-700" href="#features">Features</a></li>
            <li><a class="hover:text-brand-700" href="#how">How it works</a></li>
            <li><a class="hover:text-brand-700" href="#gallery">Gallery</a></li>
            <li><a class="hover:text-brand-700" href="#faq">FAQ</a></li>
          </ul>
        </div>
        <div class="text-sm">
          <h4 class="font-semibold">Account</h4>
          <ul class="mt-3 space-y-2 text-gray-600">
            <li><a class="hover:text-brand-700" href="<?php echo e(route('login')); ?>">Log in</a></li>
            <li><a class="hover:text-brand-700" href="<?php echo e(route('register')); ?>">Create account</a></li>
            <li><a class="hover:text-brand-700" href="<?php echo e(route('modules.index')); ?>">Modules</a></li>
            <li><a class="hover:text-brand-700" href="<?php echo e(route('community')); ?>">Community</a></li>
          </ul>
        </div>
      </div>
      <div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-gray-500">
        <p>© <span id="y"></span> Digital Theology Classroom. All rights reserved.</p>
        <p>“Let the word of Christ dwell in you richly.” — Colossians 3:16</p>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('y').textContent = new Date().getFullYear();
  </script>
</body>
</html>
<?php /**PATH C:\Users\Marc\Documents\GitHub\THESIS-FILES\thesis-app\resources\views/welcome.blade.php ENDPATH**/ ?>