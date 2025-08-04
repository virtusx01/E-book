@extends('layouts.navbar')

@section('content')
<div class="bg-white shadow-xl rounded-lg overflow-hidden">
    <div class="md:flex">
        <div class="md:w-1/3 p-8">
            <img src="{{ $book->cover_book ? asset('storage/' . $book->cover_book) : 'https://via.placeholder.com/400x600.png?text=No+Cover' }}" alt="Cover of {{ $book->title }}" class="rounded-lg shadow-lg w-full object-cover">
        </div>

        <div class="md:w-2/3 p-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-2 mb-5 border-b-2 border-black pb-2">{{ $book->title }}</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-600 mb-6">

                <div>
                    <strong>Penulis:</strong> {{ $book->author }}
                </div>

                <div>
                    <strong>Penerbit:</strong> {{ $book->publisher }}
                </div>

                <div>
                    <strong>Tanggal Rilis:</strong> {{ \Carbon\Carbon::parse($book->release_date)->format('d F Y') }}
                </div>

                <div>
                    <strong>Jumlah Halaman:</strong> {{ $book->number_of_pages }}
                </div>

                <div class="col-span-1 md:col-span-2 mt-2">
                    <strong>Category: </strong>
                    @forelse($book->categories as $category)
                        <span class="text-xs inline-block bg-blue-200 text-blue-800 rounded-full px-3 py-1 font-semibold mr-1 mb-1">
                            {{ $category->name }}
                        </span>
                    @empty
                        <span class="text-xs inline-block text-gray-500">Tidak ada kategori</span>
                    @endforelse
                </div>

            </div>

            <h3 class="text-xl font-bold text-gray-800 mt-6 mb-2">Sinopsis</h3>
            <p class="text-gray-600 leading-relaxed">{{ $book->synopsis }}</p>

            <div class="mt-8 flex gap-4">
                <a href="{{ route('books.edit', $book) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                    Edit Buku
                </a>
                 <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    <div class="p-8 border-t border-gray-200">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Isi Buku</h3>
        <textarea name="content" id="content" readonly class="block w-full resize-none p-6 focus:ring-0 rounded-md border-2 border-gray-300" style="height: 400px; cursor: default;">{{ $book->content }}</textarea>

        <div>
            <p class="mt-2 text-sm text-gray-500">Konten dapat di-scroll jika isinya panjang.</p>
        </div>
    </div>
</div>
@endsection