<?php

namespace Database\Seeders;

// use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Category;
use \App\Models\Book;
use \App\Models\BookCopy;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;


    public function run(): void
    {
        User::factory()->create([
            'name' => 'Chef Bibliothécaire',
            'email' => 'admin@gourmet.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::factory(5)->create([
            'role' => 'reader'
        ]);

        $categories = Category::factory(5)->create();

        foreach ($categories as $category) {
            $books = Book::factory(10)->create([
                'category_id' => $category->id
            ]);

            foreach ($books as $book) {
                BookCopy::factory(3)->create([
                    'book_id' => $book->id
                ]);
            }
        }
    }
}
