@extends('layouts.navbar')

@section('content')
    <h1 class="text-4xl font-bold mb-8 text-gray-800 text-center">Daftar Buku</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-8">
        <form action="{{ route('books.index') }}" method="GET" class="">
            <div class="p-4">
                <label for="search" class="block text-sm font-medium text-gray-700">Cari Judul/Penulis/Penerbit</label>
                <input type="text" name="search" id="search" value="{{ request('search') }}" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Masukkan kata kunci...">
            </div>
            <div class="p-4">
                <label for="release_date" class="block text-sm font-medium text-gray-700">Tanggal Rilis</label>
                <input type="date" name="release_date" id="release_date" value="{{ request('release_date') }}" class="p-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            </div>
            <div class='p-4'>
                <label class="block text-sm font-medium text-gray-700">Kategori (Pilih satu atau lebih)</label>
                <div id="category-filter-container" class="mt-1 flex flex-wrap gap-2 p-2 rounded-md">
                    <span
                        class="category-tag inline-block px-3 py-1 rounded-full cursor-pointer transition-colors duration-200 ease-in-out
                            {{ empty(request('category_ids')) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                        data-id=""
                    >
                        Semua Kategori
                    </span>
                    @foreach($categories as $category)
                        <span
                            class="category-tag inline-block px-3 py-1 rounded-full cursor-pointer transition-colors duration-200 ease-in-out
                                {{ in_array($category->id, request('category_ids', [])) ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                            data-id="{{ $category->id }}"
                        >
                            {{ $category->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            <div id="hidden-category-inputs">
                @if(is_array(request('category_ids')))
                    @foreach(request('category_ids') as $id)
                        <input type="hidden" name="category_ids[]" value="{{ $id }}">
                    @endforeach
                @endif
            </div>
            <div class="md:col-span-4 flex justify-end items-center gap-4">
                <a href="{{ route('books.index') }}" class="text-gray-600 hover:text-gray-800">Reset</a>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
            </div>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="flex justify-end mb-4">
         <a href="{{ route('books.add') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            + Tambah Buku Baru
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @forelse($books as $book)
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
                    <div class="flex justify-end gap-2 mt-4 items-center">
                        <a href="{{ route('books.edit', $book) }}" class="mt-3 bg-blue-600 text-white py-1 px-2 rounded hover:bg-blue-700 transition duration-300">
                            Edit
                        </a>
                        
                        <form action="{{ route('books.delete', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="mt-3 bg-red-600 text-white py-1 px-2 rounded hover:bg-red-700 transition duration-300">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500 text-xl py-10">Tidak ada buku yang cocok dengan kriteria pencarian.</p>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $books->appends(request()->query())->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterContainer = document.getElementById('category-filter-container');
            const hiddenInputsContainer = document.getElementById('hidden-category-inputs');
            const allCategoriesTag = filterContainer.querySelector('span[data-id=""]');
            let selectedCategoryIds = new Set(
                @json(is_array(request('category_ids')) ? request('category_ids') : [])
            );

            // Fungsi untuk memperbarui input tersembunyi dan tampilan tag
            function updateTagsAndInputs() {
                filterContainer.querySelectorAll('.category-tag').forEach(tag => {
                    const id = tag.dataset.id;
                    if (selectedCategoryIds.has(id) || (id === "" && selectedCategoryIds.size === 0)) {
                        tag.classList.remove('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                        tag.classList.add('bg-blue-600', 'text-white');
                    } else {
                        tag.classList.remove('bg-blue-600', 'text-white');
                        tag.classList.add('bg-gray-100', 'text-gray-700', 'hover:bg-gray-200');
                    }
                });

                // Perbarui input tersembunyi
                hiddenInputsContainer.innerHTML = '';
                selectedCategoryIds.forEach(id => {
                    if (id !== "") {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'category_ids[]';
                        input.value = id;
                        hiddenInputsContainer.appendChild(input);
                    }
                });
            }

            // Jalankan saat halaman dimuat untuk mengatur state awal
            updateTagsAndInputs();

            filterContainer.addEventListener('click', function(event) {
                const clickedTag = event.target.closest('.category-tag');
                if (clickedTag) {
                    const categoryId = clickedTag.dataset.id;

                    if (categoryId === "") {
                        selectedCategoryIds.clear();
                    } else {
                        if (selectedCategoryIds.has(categoryId)) {
                            selectedCategoryIds.delete(categoryId);
                        } else {
                            selectedCategoryIds.add(categoryId);
                        }
                        selectedCategoryIds.delete(""); 
                    }
                    updateTagsAndInputs();
                    
                }
            });

            // Tambahkan event listener ke tombol filter untuk memastikan input tersembunyi terkirim
            document.querySelector('form button[type="submit"]').addEventListener('click', function() {
            });
        });
    </script>
@endsection