<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'author',
        'release_date',
        'publisher',
        'content',
        'synopsis',
        'number_of_pages',
        'cover_book',
    ];

    

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
}
