<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function edit(Video $video)
    {
        return view('videos.edit', compact('video'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'url_video' => 'required|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200'
            ],
            [
                'url_video.required' => 'Video wajib diupload.',
                'url_video.file' => 'File yang diupload harus berupa video.',
                'url_video.mimes' => 'Format video tidak didukung. Gunakan: MP4, MOV, AVI, WMV, FLV, atau WebM.',
                'url_video.max' => 'Ukuran video maksimal 50MB.'
            ]
        );

        $path = $request->file('url_video')->store('videos', 'public');

        Video::create([
            'title' => $request->title,
            'url_video' => $path
        ]);

        return redirect()->route('videos.index')->with('success', 'video uploaded');
    }

    public function update(Request $request, Video $video)
    {
        $request->validate(
            [
                'title' => 'required|string',
                'url_video' => 'nullable|file|mimes:mp4,mov,avi,wmv,flv,webm|max:51200'
            ],
            [
                'url_video.file' => 'File yang diupload harus berupa video.',
                'url_video.mimes' => 'Format video tidak didukung. Gunakan: MP4, MOV, AVI, WMV, FLV, atau WebM.',
                'url_video.max' => 'Ukuran video maksimal 50MB.'
            ]
        );

        $data = [
            'title' => $request->title
        ];

        if($request->hasFile('url_video')){
            if($video->url_video){
                Storage::disk('public')->delete($video->url_video);
            }

            $newPath = $request->file('url_video')->store('videos', 'public');
            $data['url_video'] = $newPath;
        }

        Log::info($data);

        $video->update($data);

        return redirect()->route('videos.index')->with('success', 'video updated');
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
        if($video->url_video){
            Storage::disk('public')->delete($video->url_video);
        }

        $video->comments()->delete();

        $video->delete();
        return redirect()->back()->with('success', 'video deleted');
    }
}
