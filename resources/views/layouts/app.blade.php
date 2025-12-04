<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Magang Laravel')</title>

    <!-- Tailwind (buat layout dasar) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap 5 CSS (buat modal) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style> body { font-family: 'Poppins', sans-serif; } </style>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">Laravel Polymorph</h1>
            <div>
                <a href="{{ route('posts.index') }}" class="px-3 py-1 hover:bg-indigo-700 rounded">Blog</a>
                <a href="{{ route('videos.index') }}" class="px-3 py-1 hover:bg-indigo-700 rounded">Video</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Flash Message -->
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif

    <!-- Bootstrap JS (wajib buat modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Auto-hide flash message -->
    <script>
        setTimeout(() => {
            const msg = document.querySelector('.fixed.bottom-4');
            if(msg) msg.remove();
        }, 3000);
    </script>

    @stack('scripts')
</body>
</html>
