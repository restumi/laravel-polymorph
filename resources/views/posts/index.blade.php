@extends('layouts.app')

@section('title', 'Daftar Blog')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-semibold text-gray-800">Blog Posts</h2>

    <button type="button" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700"
            data-bs-toggle="modal" data-bs-target="#createPostModal">
        + Tambah Blog
    </button>
</div>

<!-- Modal Tambah Post -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createPostModalLabel">Buat Blog Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="content" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Tampilkan Posts & Komentar (sama seperti sebelumnya) -->
@if($posts->isEmpty())
    <p class="text-gray-500">Belum ada blog.</p>
@else
    @foreach($posts as $post)
        <div class="bg-white rounded-lg shadow p-5 mb-5">
            <h3 class="text-xl font-bold text-gray-800">{{ $post->title }}</h3>
            <p class="text-gray-600 mt-2">{{ \Illuminate\Support\Str::limit($post->content, 150) }}</p>

            <!-- Form Komentar -->
            <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-4">
                @csrf
                <div class="flex gap-2">
                    <textarea
                        name="body"
                        placeholder="Tulis komentar..."
                        class="w-full border border-gray-300 rounded px-3 py-2 text-sm"
                        rows="2"
                        required
                    ></textarea>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 whitespace-nowrap">
                        Kirim
                    </button>
                </div>
            </form>

            <!-- Komentar -->
            <div class="mt-3 space-y-2">
                @foreach($post->comments as $comment)
                    <div class="bg-gray-50 p-3 rounded border-l-4 border-indigo-500 text-sm">
                        {{ $comment->body }}
                    </div>
                @endforeach
            </div>

                <button
                    type="button"
                    class="text-indigo-600 hover:text-indigo-800 text-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#editPostModal"
                    data-id="{{ $post->id }}"
                    data-title="{{ $post->title }}"
                    data-content="{{ $post->content }}"
                >
                    Edit
                </button>

            <!-- Hapus -->
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block mt-3">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="text-red-600 hover:text-red-800 text-sm"
                    onclick="return confirm('Yakin hapus blog ini?')"
                >
                    Hapus Blog
                </button>
            </form>

        </div>
    @endforeach
@endif

<!-- Modal Edit Post -->
<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editPostModalLabel">Edit Blog</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editPostForm" method="POST">
        @csrf
        @method('PATCH')
        <div class="modal-body">
          <input type="hidden" id="edit_post_id" name="id">
          <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" id="edit_title" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Konten</label>
            <textarea name="content" id="edit_content" class="form-control" rows="4" required></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.querySelectorAll('[data-bs-target="#editPostModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const content = this.getAttribute('data-content');

        document.getElementById('edit_post_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_content').value = content;

        // Set action form dinamis
        const form = document.getElementById('editPostForm');
        form.action = `/posts/${id}`;
    });
});
</script>
@endpush
