<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-100 py-12 px-4">
        <!-- Gradient Border Wrapper -->
        <div class="bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 p-1 rounded-2xl shadow-2xl max-w-md w-full">
            <!-- Inner White Card -->
            <div class="bg-white rounded-xl p-8">

                <!-- Stylish Header -->
                <div class="text-center mb-6">
                    <p class="text-sm text-gray-500 tracking-wide uppercase mb-1">
                        Trouble Signing In?
                    </p>
                    <h2 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 via-purple-500 to-pink-500 drop-shadow">
                        Reset Your Password
                    </h2>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">
                        Forgot your password? No problem. Just enter your email address and we’ll send you a reset link.
                    </p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-sm text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <x-input-label for="email" :value="__('Email')" class="text-sm font-medium text-indigo-600" />
                        <x-text-input
                            id="email"
                            class="mt-1 w-full px-4 py-2 rounded-lg border-2 border-indigo-200 focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end">
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-400 transition-all duration-200 rounded-full px-6 py-2 text-white font-semibold shadow-md">
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
