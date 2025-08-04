<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'id' => 1,
            'name' => 'Fiction',
        ]);
        Category::create([
            'id' => 2,
            'name' => 'Action',
        ]);
        Category::create([
            'id' => 3,
            'name' => 'Romance',
        ]);
        Category::create([
            'id' => 4,
            'name' => 'Mystery',
        ]);
        Category::create([
            'id' => 5,
            'name' => 'Fantasy',
        ]);
        Category::create([
            'id' => 6,
            'name' => 'Science Fiction',
        ]);
        Category::create([
            'id' => 7,
            'name' => 'Thriller',
        ]);
        Category::create([
            'id' => 8,
            'name' => 'Horror',
        ]);
        Category::create([
            'id' => 9,
            'name' => 'Drama',
        ]);
        Category::create([
            'id' => 10,
            'name' => 'Comedy',
        ]);
        Category::create([
            'id' => 11,
            'name' => 'Adventure',
        ]);
        Category::create([
            'id' => 12,
            'name' => 'Historical Fiction',
        ]);
        Category::create([
            'id' => 13,
            'name' => 'Non-Fiction',
        ]);
        Category::create([
            'id' => 14,
            'name' => 'Biography',
        ]);
        Category::create([
            'id' => 15,
            'name' => 'Memoir',
        ]);
        Category::create([
            'id' => 16,
            'name' => 'Autobiography',
        ]);
        Category::create([
            'id' => 17,
            'name' => 'Travel',
        ]);
        Category::create([
            'id' => 18,
            'name' => 'Magic',
        ]);
        Category::create([
            'id' => 19,
            'name' => 'Spirituality',
        ]);
        Category::create([
            'id' => 20,
            'name' => 'Philosophy',
        ]);
    }
}
