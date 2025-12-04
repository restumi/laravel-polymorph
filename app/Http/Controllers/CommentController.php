<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Video;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storePostComment(Request $request, Post $post)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $post->comments()->create(['body' => $request->body]);

        return back()->with('success', 'comment!');
    }

    public function storeVideosComment(Request $request, Video $video)
    {
        $request->validate(['body' => 'required|string|max:1000']);

        $video->comments()->create(['body' => $request->body]);

        return back()->with('success', 'comment!');
    }
}
