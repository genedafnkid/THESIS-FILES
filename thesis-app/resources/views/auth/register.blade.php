<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100 py-12 px-4">
        <!-- Gradient Border Box -->
        <div class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 p-1 rounded-2xl shadow-2xl max-w-md w-full">
            <!-- Inner White Card -->
            <div class="bg-white rounded-xl p-8">
                
                <!-- Stylish Header -->
                <div class="text-center mb-8">
                    <p class="text-sm text-gray-500 tracking-wide uppercase mb-1">
                        Welcome to Our Platform
                    </p>
                    <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 drop-shadow">
                        Create Your Account
                    </h2>
                    <p class="text-sm text-gray-500 mt-2">
                        Start your journey with us — it only takes a minute!
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-5">
                        <x-input-label for="name" :value="__('Name')" class="text-sm font-medium text-indigo-600" />
                        <x-text-input
                            id="name"
                            class="mt-1 w-full px-4 py-2 rounded-lg border-2 border-indigo-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
                    </div>

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
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-sm font-medium text-indigo-600" />
                        <x-text-input
                            id="password_confirmation"
                            class="mt-1 w-full px-4 py-2 rounded-lg border-2 border-indigo-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Footer -->
                    <div class="flex items-center justify-between">
                        <a href="{{ route('login') }}" class="text-sm text-indigo-500 hover:underline">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ml-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-400 transition-all duration-200 rounded-full px-6 py-2 text-white font-semibold shadow-md">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
