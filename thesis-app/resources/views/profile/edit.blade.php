@extends('layouts.app')
@section('title', 'Account Settings • Digital Theology Classroom')
@section('content')

  <!-- Page header -->
  <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600 shadow-glow">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-purple-700">Account Settings</h1>
        <p class="mt-2 text-gray-600">Manage your profile, update your password, or delete your account.</p>
      </div>
    </div>
  </section>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">

    <!-- 👤 Profile Info & Profile Picture -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-semibold text-pink-700 mb-4">👤 Profile Information</h2>

        @if(session('status') === 'profile-updated')
          <div class="mb-4 rounded-lg bg-green-50 text-green-800 px-4 py-3 text-sm">
            Profile updated successfully.
          </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6"
          x-data="{ preview: null }">
          @csrf
          @method('PATCH')

          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Avatar / Upload Card --}}
            <div class="lg:col-span-1">
              <div class="rounded-xl border border-slate-200 p-4">
                <p class="text-sm font-medium text-slate-700">Profile Picture</p>
                <p class="text-xs text-slate-500 mt-1">PNG/JPG/WebP up to 2MB.</p>

                <div class="mt-4 flex items-center gap-4">
                  {{-- Current or Preview --}}
                  <div class="relative">
                    <div class="w-24 h-24 rounded-full overflow-hidden ring-1 ring-slate-200 bg-slate-50">
                      {{-- Live preview if a new file is selected --}}
                      <img x-show="preview" x-bind:src="preview" alt="New preview" class="w-full h-full object-cover">
                      {{-- Existing avatar if no preview --}}
                      @php $pfp = auth()->user()->profile_picture; @endphp
                      <img x-show="!preview && '{{ $pfp ? 1 : 0 }}' == '1'"
                        src="{{ Storage::url($pfp) }}?v={{ \Illuminate\Support\Str::uuid() }}"
                        alt="Current profile picture" class="w-full h-full object-cover">
                      {{-- Placeholder if none --}}
                      <div x-show="!preview && '{{ $pfp ? 1 : 0 }}' == '0'"
                        class="w-full h-full flex items-center justify-center text-slate-400 text-sm">
                        <span>No photo</span>
                      </div>
                    </div>
                  </div>

                  <div>
                    <label for="profile_picture"
                      class="inline-flex items-center rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white px-3 py-2 text-sm cursor-pointer">
                      Change photo
                    </label>
                    <input class="hidden" id="profile_picture" name="profile_picture" type="file"
                      accept="image/png,image/jpeg,image/webp" @change="
                      if ($event.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = (e) => preview = e.target.result;
                        reader.readAsDataURL($event.target.files[0]);
                      } else {
                        preview = null;
                      }
                    ">
                    @error('profile_picture')
                      <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                    @enderror

                    @if($pfp)
                      <div class="mt-3">
                        <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                          <input type="checkbox" name="remove_profile_picture" value="1"
                            class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-400">
                          Remove current photo
                        </label>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            {{-- Text Fields Card --}}
            <div class="lg:col-span-2">
              <div class="rounded-xl border border-slate-200 p-4 sm:p-6 space-y-4">
                <div>
                  <label for="firstName" class="block text-sm font-medium text-slate-700">First Name</label>
                  <input id="firstName" name="firstName" type="text"
                    value="{{ old('firstName', auth()->user()->firstName) }}"
                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                  @error('firstName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                  <label for="lastName" class="block text-sm font-medium text-slate-700">Last Name</label>
                  <input id="lastName" name="lastName" type="text" value="{{ old('lastName', auth()->user()->lastName) }}"
                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                  @error('lastName') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                  <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                  <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}"
                    class="mt-1 w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-slate-900 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-200">
                  @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror

                  @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !auth()->user()->hasVerifiedEmail())
                    <p
                      class="text-xs mt-2 text-amber-700 bg-amber-50 border border-amber-200 rounded px-2 py-1 inline-flex items-center gap-2">
                      <span>Unverified email.</span>
                      <button form="send-verification" class="underline decoration-amber-600 hover:text-amber-900">
                        Resend verification
                      </button>
                    </p>
                  @endif
                </div>
              </div>
            </div>
          </div>

          <div class="flex items-center justify-end gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-white font-semibold shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-200">
              Save Changes
            </button>
          </div>
        </form>

        {{-- Separate hidden form for resend verification (Jetstream convention) --}}
        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="hidden">
          @csrf
        </form>
      </div>
    </div>


    <!-- 🔐 Update Password -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-semibold text-pink-700 mb-4">🔐 Update Password</h2>
        @include('profile.partials.update-password-form')
      </div>
    </div>

    <!-- ⚠️ Delete Account -->
    <div class="p-[2px] rounded-2xl bg-gradient-to-r from-pink-500 to-purple-600">
      <div class="bg-white rounded-2xl p-6 sm:p-8">
        <h2 class="text-xl sm:text-2xl font-semibold text-pink-700 mb-4">⚠️ Delete Account</h2>
        @include('profile.partials.delete-user-form')
      </div>
    </div>

  </main>
@endsection