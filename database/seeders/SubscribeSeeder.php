<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscribe;

class SubscribeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subscribe::insert([
            [
                'id' => 1,
                'email' => 'rekayasacyber@gmail.com'
            ],
            [
                'id' => 2,
                'email' => 'doniyanto88@students.unnes.ac.id'
            ]
        ]);
    }
}
