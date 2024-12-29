<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Interest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->latest()->get(); 
        return view('posts.index-post', compact('posts'));
    }

    public function create()
    {
        $interests = Interest::where('field', auth()->user()->field)->get();
        return view('posts.create-post', compact('interests'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Store the image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        // Create the post
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('posts.index-post')
            ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'interests']);
        return view('posts.show', compact('post'));
    }
}