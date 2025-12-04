<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::with('comments')->latest()->get();
        return view('videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url_video' => 'required|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200'
        ]);

        $path = $request->file('url_video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'url_video' => $path
        ]);

        return redirect()->route('videos.index')->with('success', 'video uploaded');
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
    public function destroy(Video $video)
    {
        $video->delete();
        return redirect()->back()->with('success', 'video deleted');
    }
}
