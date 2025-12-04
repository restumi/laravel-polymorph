@extends('layouts.app')

@section('title', 'Tambah Video Baru')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Tambah Video Baru</h2>

    <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-medium mb-2">Judul Video</label>
            <input
                type="text"
                id="title"
                name="title"
                class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                placeholder="Contoh: Tutorial Laravel Polymorph"
                required
            >
        </div>

        <div class="mb-6">
            <label for="url_video" class="block text-gray-700 font-medium mb-2">Upload Video</label>
            <input
                type="file"
                id="url_video"
                name="url_video"
                accept="video/*"
                class="block w-full text-sm text-gray-500
                    file:mr-4 file:py-2 file:px-4
                    file:rounded file:border-0
                    file:bg-indigo-600 file:text-white
                    hover:file:bg-indigo-700"
                required
            >
            <p class="text-sm text-gray-500 mt-1">Format: MP4, MOV, AVI (max 50MB)</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('videos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Simpan Video
            </button>
        </div>
    </form>
</div>
@endsection
