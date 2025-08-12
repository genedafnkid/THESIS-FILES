@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-pink-600 to-purple-700 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-extrabold mb-6 tracking-wide">Theology Classroom</h1>
        <nav class="space-y-4 font-medium">
            <a href="{{ route('dashboard') }}" class="block hover:text-purple-200">📊 Dashboard</a>
            <a href="{{ route('modules.index') }}" class="block hover:text-purple-200">📚 Modules</a>
            <a href="#" class="block hover:text-purple-200">🤝 Community</a>
            <a href="#" class="block hover:text-purple-200">⚙️ Settings</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        <!-- Header -->
        <div class="p-[2px] rounded-xl bg-gradient-to-r from-pink-500 to-purple-600 mb-8">
            <div class="bg-white rounded-xl p-6 shadow-xl">
                <h1 class="text-3xl font-extrabold text-purple-700 mb-2">🤝 Community Discussion Board</h1>
                <p class="text-gray-600">Share your thoughts, ask questions, and connect with fellow students.</p>
            </div>
        </div>

        <!-- Post Form (Only for Admin & Instructor) -->
        @hasanyrole('admin|instructor')
            <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                <form action="{{ route('community.store') }}" method="POST">
                    @csrf
                    <textarea name="content" rows="4" class="w-full p-4 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="What's on your mind?" required></textarea>
                    <div class="flex justify-end mt-4">
                        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
                            Post
                        </button>
                    </div>
                </form>
            </div>
        @endhasanyrole

        <!-- Posts -->
        <div class="space-y-6">
            @forelse ($posts as $post)
                <div class="bg-white p-6 rounded-xl shadow">
                    <div class="flex justify-between items-center mb-2">
                        <h2 class="text-purple-700 font-bold">{{ $post->user->name }}</h2>
                        <span class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-800">{{ $post->content }}</p>

                    <!-- Reply Form (Everyone can reply) -->
                    <div class="mt-4 border-t pt-3">
                        <form action="{{ route('community.reply', $post->id) }}" method="POST">
                            @csrf
                            <textarea 
                                name="reply_content" 
                                rows="2" 
                                class="w-full border rounded-lg p-2 focus:ring-purple-500 focus:border-purple-500" 
                                placeholder="Write a reply..." required></textarea>
                            <button type="submit" class="mt-2 px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Reply
                            </button>
                        </form>
                    </div>

                    <!-- Replies -->
                    @if ($post->replies && $post->replies->count())
                        <div class="mt-3 pl-4 border-l border-gray-200">
                            @foreach ($post->replies as $reply)
                                <div class="mb-2">
                                    <p class="text-sm font-semibold text-purple-500">{{ $reply->user->name }}</p>
                                    <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                    <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-center text-gray-600">No posts yet. Start the conversation!</p>
            @endforelse
        </div>
    </main>
</div>
@endsection
