<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('admin1234'),
            "role" => "admin",
        ]);

        User::create([
            "name" => "owner",
            "email" => "owner@gmail.com",
            "password" => Hash::make('owner1234'),
            "role" => "owner",
        ]);

        User::create([
            "name" => "user",
            "email" => "user@gmail.com",
            "password" => Hash::make('user1234'),
            "role" => "user",
        ]);
    }
}
