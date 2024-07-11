<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values = [
            [
                'genre' => 'Filipiniana'
            ],
            [
                'genre' => 'General Reference'
            ],
            [
                'genre' => 'Fiction'
            ],
            [
                'genre' => 'Arts and Sciences'
            ],
            [
                'genre' => 'Criminology'
            ],
            [
                'genre' => 'Business'
            ],
            [
                'genre' => 'Computer Studies'
            ],
            [
                'genre' => 'Education'
            ],
            [
                'genre' => 'Midwifery'
            ],
            [
                'genre' => 'Special Collection'
            ],
            [
                'genre' => 'Bangko Sentral ng Pilipina (BSP)'
            ],

        ];

        Genre::insert($values);
    }
}
