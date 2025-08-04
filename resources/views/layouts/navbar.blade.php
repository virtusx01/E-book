<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Buku Saya</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans">

    <nav class="bg-blue-800 shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div>
                    <a href="{{ url('/') }}" class="text-white text-xl font-bold">📘 E-Book</a>
                </div>

                <div class="hidden md:flex items-center space-x-4">
                    <a href="{{ route('books.index') }}" class="text-white hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md">Book</a>
                    <a href="{{ route('categories.index') }}" class="text-white hover:bg-blue-700 hover:text-white px-3 py-2 rounded-md">Category</a>
                </div>
                
                <div class="md:hidden flex items-center">
                    <button class="text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4 mt-6">
        @yield('content')
    </main>

</body>
</html>