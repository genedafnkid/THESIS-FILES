<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class CommunityController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); 
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
            'content' => $request->content,
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
            'content' => 'required|max:1000',
        ]);

        // Make sure the post exists
        $post = Post::findOrFail($postId);

        // Save reply as a new post but linked to original
        Post::create([
            'content' => $request->content,
            'user_id' => auth()->id(),
            'parent_id' => $post->id // Make sure your posts table has parent_id for replies
        ]);

        return redirect()->route('community')->with('success', 'Reply posted successfully!');
    }
}
