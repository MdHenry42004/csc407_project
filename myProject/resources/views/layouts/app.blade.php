<!--Asked Gemini to create a simple layout html file for other views to extend and from that it grabbed cdn.tailwindcss.com -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Church Member Database')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold">Grace Fellowship Database</h1>
            <div class="space-x-4">
                <a href="{{ route('contacts.index') }}" class="hover:underline">People</a>
                <a href="{{ route('events.index') }}" class="hover:underline">Events</a>
                <a href="{{ route('donations.index') }}" class="hover:underline">Donations</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-6">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>