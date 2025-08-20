@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-br from-pink-600 to-purple-700 text-white p-6 hidden md:block">
        <h1 class="text-2xl font-extrabold mb-6 tracking-wide">Theology Classroom</h1>
        <nav class="space-y-4 font-medium">
            <a href="{{ route('dashboard') }}" class="block hover:text-purple-200">📊 Dashboard</a>
            <a href="{{ route('modules.index') }}" class="block hover:text-purple-200">📚 Modules</a>
            <a href="{{ route('community') }}" class="block hover:text-purple-200">🤝 Community</a>
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

                    <p class="text-gray-800 mb-3">{{ $post->content }}</p>

                    <!-- Admin/Instructor Edit/Delete Controls -->
                    @hasanyrole('admin|instructor')
                        <div class="flex space-x-2 mb-4">
                            <!-- Edit Button (Modal trigger) -->
                            <button 
                                onclick="document.getElementById('edit-post-{{ $post->id }}').classList.remove('hidden')" 
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                ✏️ Edit
                            </button>

                            <!-- Delete Form -->
                            <form action="{{ route('community.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600">
                                    🗑️ Delete
                                </button>
                            </form>
                        </div>

                        <!-- Edit Modal -->
                        <div id="edit-post-{{ $post->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                            <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
                                <h3 class="text-lg font-bold mb-4 text-purple-700">Edit Post</h3>
                                <form action="{{ route('community.update', $post->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <textarea name="content" rows="4" class="w-full p-3 border rounded">{{ $post->content }}</textarea>
                                    <div class="flex justify-end mt-4 space-x-2">
                                        <button type="button" onclick="document.getElementById('edit-post-{{ $post->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endhasanyrole

                    <!-- Reply Form (Students) -->
                    <div class="mt-4 border-t pt-3">
                        <form action="{{ route('community.reply', $post->id) }}" method="POST">
                            @csrf
                            <textarea 
                                name="content" 
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
                                <div class="mb-3 p-2 bg-gray-50 rounded-lg">
                                    <p class="text-sm font-semibold text-purple-500">{{ $reply->user->name }}</p>
                                    <p class="text-sm text-gray-700">{{ $reply->content }}</p>
                                    <p class="text-xs text-gray-400">{{ $reply->created_at->diffForHumans() }}</p>

                                    <!-- Reply Edit/Delete (only reply owner) -->
                                    @if ($reply->user_id === auth()->id())
                                        <div class="flex space-x-2 mt-1">
                                            <!-- Edit Button -->
                                            <button 
                                                onclick="document.getElementById('edit-reply-{{ $reply->id }}').classList.remove('hidden')" 
                                                class="px-2 py-1 text-xs bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                                ✏️ Edit
                                            </button>

                                            <!-- Delete Form -->
                                            <form action="{{ route('replies.destroy', $reply->id) }}" method="POST" onsubmit="return confirm('Delete this reply?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 text-xs bg-red-500 text-white rounded hover:bg-red-600">
                                                    🗑️ Delete
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div id="edit-reply-{{ $reply->id }}" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                                            <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
                                                <h3 class="text-lg font-bold mb-4 text-purple-700">Edit Reply</h3>
                                                <form action="{{ route('replies.update', $reply->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <textarea name="content" rows="3" class="w-full p-3 border rounded">{{ $reply->content }}</textarea>
                                                    <div class="flex justify-end mt-4 space-x-2">
                                                        <button type="button" onclick="document.getElementById('edit-reply-{{ $reply->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">Cancel</button>
                                                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
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
