@extends('layouts.app')

@section('content')
<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        <!-- Profile Info -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-[2px] rounded-xl shadow-lg">
            <div class="bg-white rounded-xl p-6">
                <h2 class="text-2xl font-semibold text-pink-700 mb-4">👤 Profile Information</h2>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-[2px] rounded-xl shadow-lg">
            <div class="bg-white rounded-xl p-6">
                <h2 class="text-2xl font-semibold text-pink-700 mb-4">🔐 Update Password</h2>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-600 p-[2px] rounded-xl shadow-lg">
            <div class="bg-white rounded-xl p-6">
                <h2 class="text-2xl font-semibold text-pink-700 mb-4">⚠️ Delete Account</h2>
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>
@endsection
