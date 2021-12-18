<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@nblc.com',
                'alternative_email' => 'ivanfaathirza@gmail.com',
                'password' => Hash::make('admin')
            ]
        ]);
    }
}
