<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderator Panel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">Moderator Panel</h1>
            <nav>
                <a href="{{ route('moderator.discounts.index') }}" class="px-4 py-2 bg-blue-500 text-white rounded">Discounts</a>
                <a href="{{ route('home') }}" class="px-4 py-2 bg-gray-500 text-white rounded ml-2">Back to Site</a>
            </nav>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>