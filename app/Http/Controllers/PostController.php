<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('comments')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        Post::create($request->all());

        return redirect()->route('posts.index')->with('success', 'Blog success uploaded!');
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $post->update($request->only('title', 'content'));

        return redirect()->route('posts.index')->with('success', 'Blog updated!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->comments()->delete();
        $post->delete();
        return redirect()->back()->with('success', 'Blog deleted');
    }
}
