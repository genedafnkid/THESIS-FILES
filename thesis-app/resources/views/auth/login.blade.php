<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100 py-12 px-4">
        <!-- Gradient Border Box -->
        <div class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 p-1 rounded-2xl shadow-2xl max-w-md w-full">
            <!-- Inner White Card -->
            <div class="bg-white rounded-xl p-8">
                
                <!-- Stylish Header -->
                <div class="text-center mb-8">
                    <p class="text-sm text-gray-500 tracking-wide uppercase mb-1">
                        Welcome Back
                    </p>
                    <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 drop-shadow">
                        Sign In to Your Account
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        We're glad to see you again 👋
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-5">
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-indigo-600" />
                        <x-text-input
                            id="email"
                            class="mt-1 w-full px-4 py-2 rounded-lg border-2 border-indigo-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-indigo-600" />
                        <x-text-input
                            id="password"
                            class="mt-1 w-full px-4 py-2 rounded-lg border-2 border-indigo-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember"
                            >
                            <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-500 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-400 transition-all duration-200 rounded-full px-6 py-2 text-white font-semibold shadow-md">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
