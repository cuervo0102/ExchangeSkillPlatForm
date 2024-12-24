<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Interest;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
            
            return view('posts.index', compact('posts'));
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

       
        $imagePath = $request->file('image')->store('posts', 'public');

        
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image_path' => $imagePath,
            'user_id' => auth()->id()
        ]);

        

        return redirect()->route('posts.index')
        ->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'interests']);
        return view('posts.show', compact('post'));
    }
}

