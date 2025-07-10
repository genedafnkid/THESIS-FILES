<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class CommunityController extends Controller
{
    // Show all posts
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); // Fetch posts with user info
        return view('community', compact('posts'));    // Pass to Blade view
    }

    // Store new post
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        auth()->user()->posts()->create([
            'content' => $request->content,
        ]);

        return redirect()->route('community')->with('success', 'Post created successfully!');
    }
}
