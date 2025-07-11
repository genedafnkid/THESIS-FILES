@extends('layouts.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-6">
        <div class="bg-white p-6 rounded-xl shadow">
            <h1 class="text-3xl font-extrabold text-purple-700 mb-4">🕊️ Virtual Faith Room</h1>
            <p class="text-gray-600 mb-6">Explore your gamified theology content below.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Example Game 1 -->
                <div class="aspect-video border rounded-xl overflow-hidden shadow">
                    <iframe src="https://example.com/game1" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                </div>

                <!-- Example Game 2 -->
                <div class="aspect-video border rounded-xl overflow-hidden shadow">
                    <iframe src="https://example.com/game2" class="w-full h-full" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
