<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin = [
            'username' => 'tcgc_lrc',
            'password' => Hash::make('123456789')
        ];

        User::create($admin);
    }
}
