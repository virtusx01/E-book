@extends('layouts.navbar')

@section('content')
    <div class="text-center bg-white rounded-lg mb-12">
        <h1 class="text-5xl font-extrabold text-gray-800">Selamat Datang di Ebook</h1>
        <p class="text-gray-600 mt-4 text-lg">Temukan dan baca buku favoritmu di sini.</p>

        <form action="{{ route('books.index') }}" method="GET" class="mt-8 max-w-xl mx-auto">
            <div class="flex items-center border-2 border-blue-800 rounded-full overflow-hidden">
                <input type="search" name="search" placeholder="Cari Judul, Penulis, atau Penerbit..." class="w-full px-6 py-3 text-gray-700 focus:outline-none">
                <button type="submit" class="bg-blue-800 text-white px-6 py-3 hover:bg-blue-600 focus:outline-none">Cari</button>
            </div>
        </form>
    </div>
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Buku Pilihan Hari Ini</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
            @forelse ($randomBooks as $book)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden group hover:scale-110 transition-transform duration-300">
                    <a href="{{ route('books.show', $book) }}">
                        <img src="{{ $book->cover_book ? asset('storage/' . $book->cover_book) : 'https://via.placeholder.com/300x400.png?text=No+Cover' }}" alt="Cover {{ $book->title }}" class="w-full h-64 object-fit">
                    </a>
                    <div class="p-4">
                        <h3 class="font-bold text-lg truncate">{{ $book->title }}</h3>
                        <p class="text-gray-600 text-xs ">Penulis: {{ $book->author }}</p>
                        <p class="text-gray-500 text-xs ">Penerbit: {{ $book->publisher }}</p>
                        <p class="text-xs text-gray-500 font-bold">Rilis: {{ \Carbon\Carbon::parse($book->release_date)->format('d M Y') }}</p>
                        <div class="mt-2">
                            @forelse($book->categories as $category)
                                <span class="text-xs inline-block bg-blue-200 text-blue-800 rounded-full px-3 py-1 font-semibold mr-1 mb-1">
                                    {{ $category->name }}
                                </span>
                            @empty
                                <span class="text-xs inline-block text-gray-500">Tidak ada kategori</span>
                            @endforelse
                        </div>
                        <p class="text-gray-500 text-xs line-clamp-4">Sinopsis:<br> "{{ $book->synopsis }}"</p>
                        
                    </div>
                </div>
            
            @empty
                <p class="text-center col-span-3 text-gray-500">Belum ada buku tersedia.</p>
            @endforelse
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('books.index') }}" class="bg-gray-800 text-white font-bold py-3 px-8 rounded-full hover:bg-gray-700 transition duration-300">
                    Lihat Lebih Banyak Buku
                </a>
            </div>
        </div>
    </div>
@endsection