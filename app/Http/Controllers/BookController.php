<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{   
    // Menampilkan daftar buku
    public function index(Request $request)
    {
        $query = Book::with('categories'); 
        $categories = Category::all();

        // Filter berdasarkan pencarian (judul, penulis, penerbit)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('author', 'like', "%{$search}%")
                    ->orWhere('publisher', 'like', "%{$search}%");
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_ids')) {
            $categoryIds = $request->input('category_ids');
            foreach ($categoryIds as $id) {
                $query->whereHas('categories', function ($q) use ($id) {
                    $q->where('id', $id);
                });
            }
        }

        // Filter berdasarkan tanggal rilis
        if ($request->filled('release_date')) {
            $query->whereDate('release_date', $request->input('release_date'));
        }

        $books = $query->latest()->paginate(10);

        return view('books.index', compact('books', 'categories'));
    }

    // Menampilkan detail buku
    public function show(Book $book)
    {
        return view('books.detail', compact('book'));
    }

    // Menampilkan form tambah buku
    public function addBookForm()
    {
        $categories = Category::all();
        return view('books.add', compact('categories'));
    }

    // Menyimpan buku baru/update buku yang sudah ada
    public function storeBook(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'publisher' => 'required|string|max:255',
            'content' => 'required|string',
            'synopsis' => 'required|string',
            'number_of_pages' => 'required|integer|max:255',
            'cover_book' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10000',
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id' 

        ]);

        $bookData = $request->except(['cover_book', 'category_ids']);

        if ($request->hasFile('cover_book')) {
            if ($book && $book->cover_book) {
                Storage::disk('public')->delete($book->cover_book);
            }
            $path = $request->file('cover_book')->store('covers', 'public');
            $bookData['cover_book'] = $path;
        }

        // Buat atau update data buku utama
        $createdOrUpdatedBook = Book::updateOrCreate(['id' => $book->id ?? null], $bookData);

        // Sinkronkan kategori. Metode sync() akan otomatis menambah/menghapus relasi di pivot table.
        $createdOrUpdatedBook->categories()->sync($request->input('category_ids'));

        return redirect()->route('books.index')->with('success', 'Buku berhasil disimpan!');
    }
    public function editBook(Book $book)
    {
        $categories = Category::all();
        return view('books.update', compact('book', 'categories'));
    }

    // Menghapus buku
    public function deleteBook(Book $book)
    {
        // Hapus file cover dari storage jika ada
        if ($book->cover_book) {
            Storage::disk('public')->delete($book->cover_book);
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
