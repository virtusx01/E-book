@extends('layouts.navbar')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
    <div class="md:col-span-1">
        <div class="bg-white p-6 rounded-lg shadow-md sticky top-6">
            {{-- Tentukan judul form berdasarkan apakah kita sedang mengedit atau menambah --}}
            <h2 class="text-2xl font-bold mb-4">{{ $category ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h2>

            {{-- Tentukan action dan method form --}}
            <form action="{{ $category ? route('categories.update', $category) : route('categories.store') }}" method="POST">
                @csrf
                {{-- Jika ini adalah form edit, tambahkan method PUT --}}
                @if($category)
                    @method('PUT')
                @endif
                
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                    <input type="text" name="name" id="category-name" value="{{ old('name', $category->name ?? '') }}" required class="border-b-2 border-black p-2 mt-1 block w-full focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    {{-- Jika ini form edit, tampilkan tombol Batal --}}
                    @if($category)
                        <a href="{{ route('categories.index') }}" class="bg-gray-200 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-300">Batal</a>
                    @endif
                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        {{ $category ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4 text-center">Daftar Kategori</h2>
             @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
             @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-blue-100">
                        <th class="p-3">Nama Kategori</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-3">{{ $cat->name }}</td>
                        <td class="p-3 text-right">
                            <a href="{{ route('categories.edit', $cat) }}" class="text-sm text-yellow-500 hover:text-yellow-700 mr-2 font-semibold">Edit</a>
                            <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 font-semibold">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="2" class="p-3 text-center text-gray-500">Belum ada kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection