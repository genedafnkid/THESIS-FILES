<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin • Approved Users</title>
  <!-- Tailwind -->
  @vite(entrypoints: ['resources/js/app.js'])

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
  @include('layouts.navbar')


  <!-- Main -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Tabs -->
    <div class="mb-6 flex flex-wrap gap-2">
      <a href="{{ route('admin.users') }}"
         class="px-4 py-2 rounded-xl border transition @if(request()->routeIs('admin.users')) bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow @else bg-white text-gray-700 hover:border-brand-200 @endif">
         Pending
      </a>
      <a href="{{ route('admin.users.approved') }}"
         class="px-4 py-2 rounded-xl border transition @if(request()->routeIs('admin.users.approved')) bg-gradient-to-r from-brand-500 to-indigo-600 text-white shadow-glow @else bg-white text-gray-700 hover:border-brand-200 @endif">
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

    @if (session('success'))
      <div class="mb-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-green-800">
        {{ session('success') }}
      </div>
    @endif

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
            @forelse ($users as $user)
              <tr class="hover:bg-brand-50/40 align-top">
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $user->firstName ?? $user->name }} {{ $user->lastName ?? '' }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                  <span class="inline-flex flex-wrap gap-2">
                    {{ $user->roles->pluck('name')->map(fn($r) => ucfirst($r))->join(', ') ?: '—' }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  <div class="flex flex-wrap gap-2">
                    {{-- Quick set role --}}
                    @foreach ($roles as $role)
                      @if (!$user->hasRole($role->name))
                        <form action="{{ route('admin.changeRole', ['id' => $user->id, 'role' => $role->name]) }}" method="POST">
                          @csrf
                          <button type="submit"
                            class="text-xs rounded-lg bg-slate-700 hover:bg-slate-800 text-white px-3 py-1">
                            Set {{ ucfirst($role->name) }}
                          </button>
                        </form>
                      @endif
                    @endforeach

                    {{-- Revoke to pending --}}
                    <form action="{{ route('admin.revokeUser', $user->id) }}" method="POST" onsubmit="return confirm('Revoke this user to pending?');">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="text-xs rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1">
                        Revoke to Pending
                      </button>
                    </form>

                    {{-- Deny --}}
                    <form action="{{ route('admin.denyUser', $user->id) }}" method="POST" onsubmit="return confirm('Move this user to denied?');">
                      @csrf
                      @method('PATCH')
                      <button type="submit" class="text-xs rounded-lg bg-red-500 hover:bg-red-600 text-white px-3 py-1">
                        Deny
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                  No approved users.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </main>
</body>
</html>
