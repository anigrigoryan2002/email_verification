<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('pass123456'), 
            'role_id' => 1,
            'created_at' => now(), 
            'updated_at' => now(),
        ]);
    }
}
