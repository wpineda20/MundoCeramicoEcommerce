<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                "id" => 1,
                "client_type" => 0,
                "name" => "Leonel",
                "phone" => "79419348",
                "email" => "leonellopez647@gmail.com",
                "email_verified_at" => null,
                "password" => Hash::make('Leonel23'),
                'role_id' => 1,
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now()],
            [
                "id" => 2,
                "client_type" => 0,
                "name" => "William",
                "phone" => "79419348",
                "email" => "wpineda@cultura.gob.sv",
                "email_verified_at" => null,
                "password" => Hash::make('Itca123!'),
                'role_id' => 1,
                "remember_token" => null,
                "created_at" => now(),
                "updated_at" => now()],
            
        ]);
    }
}
