<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $value = [
            'date_acquired' => '2024-04-10',
            'author' => 'okss',
            'title' => 'sample_title'
            
        ];

        Book::create($value);
    }
}
