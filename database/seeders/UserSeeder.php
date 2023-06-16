<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Magasin",
            "password" => Hash::make("magasin"),
            "email" => "magasin@gmail.com",
            "role_id" => 1
        ]);

        User::create([
            "name" => "Analakely",
            "password" => Hash::make("analakely"),
            "email" => "analakely@gmail.com",
            "role_id" => 2
        ]);
    }
}
