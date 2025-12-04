@extends('layouts.app')

@section('title', 'Daftar Video')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Videos</h2>

    <a href="{{ route('videos.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        + Tambah Video
    </a>
</div>

@if($videos->isEmpty())
    <p class="text-gray-500">Belum ada video.</p>
@else
    @foreach($videos as $video)
        <div class="bg-white rounded-lg shadow p-5 mb-5">
            <h3 class="text-xl font-bold text-gray-800">{{ $video->title }}</h3>
            <p class="text-gray-600 mt-1">URL: <a href="{{ $video->url_video }}" target="_blank" class="text-indigo-600">{{ $video->url_video }}</a></p>

            <!-- Form Komentar -->
            <form action="{{ route('videos.comments.store', $video) }}" method="POST" class="mt-4">
                @csrf
                <div class="flex gap-2">
                    <textarea
                        name="body"
                        placeholder="Komentar video..."
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm"
                        rows="2"
                        required
                    ></textarea>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 whitespace-nowrap">
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Daftar Komentar -->
            <div class="mt-3 space-y-2">
                @foreach($video->comments as $comment)
                    <div class="bg-gray-50 p-3 rounded border-l-4 border-indigo-500 text-sm">
                        {{ $comment->body }}
                    </div>
                @endforeach
            </div>

            <!-- Tombol Hapus -->
            <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline-block mt-3">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="text-red-600 hover:text-red-800 text-sm"
                    onclick="return confirm('Yakin hapus video ini?')"
                >
                    Hapus Video
                </button>
            </form>
        </div>
    @endforeach
@endif
@endsection
