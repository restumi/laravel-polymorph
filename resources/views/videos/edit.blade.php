@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Video</h2>

    <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Judul Video</label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $video->title) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-indigo-500"
                required
            >
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Video Saat Ini</label>
            <video src="{{ asset('storage/' . $video->url_video) }}" controls class="w-full rounded" style="max-height: 200px;"></video>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Ganti Video (opsional)</label>
            <input
                type="file"
                name="url_video"
                accept="video/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-indigo-600 file:text-white hover:file:bg-indigo-700"
            >
            <p class="text-sm text-gray-500 mt-1">Biarkan kosong jika tidak ingin ganti video</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('videos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Batal</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
