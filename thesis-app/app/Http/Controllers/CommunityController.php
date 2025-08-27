<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Reply;


class CommunityController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with([
            'user',
            'replies.user'
        ])
        ->latest()
        ->get();

        return view('community', compact('posts'));
    }


    // Store new post (Only Admin & Instructor)
    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['admin', 'instructor'])) {
            abort(403, 'You are not allowed to create main discussion posts.');
        }

        $request->validate([
            'content' => 'required|max:1000',
        ]);

        auth()->user()->posts()->create([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('community')->with('success', 'Post created successfully!');
    }

    // Store reply (Only Students)
    public function reply(Request $request, $postId)
    {
        if (!auth()->user()->hasRole('student')) {
            abort(403, 'Only students can reply to posts.');
        }

        $request->validate([
            'content'    => 'required|max:1000',
            'parent_id'  => 'nullable|exists:replies,id', // optional, for nested replies
        ]);

        $post = Post::findOrFail($postId);

        Reply::create([
            'post_id'   => $post->id,
            'user_id'   => auth()->id(),
            'content'   => $request->input('content'),
        ]);

        return redirect()->route('community')->with('success', 'Reply posted successfully!');
    }

    public function edit(Post $post)
    {
        return view('community.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $post->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('community')->with('success', 'Post updated successfully!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // Delete replies first
        $post->replies()->delete();

        $post->delete();

        return redirect()->route('community')->with('success', 'Post and its replies deleted successfully.');
    }

    // Edit a reply (show form)
    public function editReply(Reply $reply)
    {
        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('replies.edit', compact('reply'));
    }

    // Update a reply
    public function updateReply(Request $request, Reply $reply)
    {
        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $reply->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->route('community')->with('success', 'Reply updated successfully!');
    }

    // Delete a reply
    public function destroyReply(Reply $reply)
    {
        if ($reply->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reply->delete();

        return redirect()->route('community')->with('success', 'Reply deleted successfully!');
    }

}
