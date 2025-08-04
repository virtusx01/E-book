<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class HomeController extends Controller
{
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
            $query->whereHas('categories', function ($q) use ($request) {
                $q->whereIn('id', $request->input('category_ids'));
            });
        }

        // Filter berdasarkan tanggal rilis
        if ($request->filled('release_date')) {
            $query->whereDate('release_date', $request->input('release_date'));
        }

        $books = $query->latest()->paginate(10);

        // Mengambil book list secara random
        $randomBooks = Book::inRandomOrder()->limit(5)->get();
        return view('homepage', compact('randomBooks','books', 'categories'));
    }
}
