<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Client;

class OauthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::insert([
            [
                "id" => "9ab1158d-bff6-4326-8c5d-94f64c91268b",
                "user_id" => null,
                "name" => "Mundo Cerámico Auth",
                "secret" => null,
                // "secret" => ebkvikEJx2Fp9IyJfLQSLeACqyKfehQ4Bvbmsh58,
                "provider" => null,
                "redirect" => "http://localhost:5173/callback",
                "personal_access_client" => "0",
                "password_client" => "0",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => "9ab11523-2afe-4c92-a107-e3b8aeb6a4c9",
                "user_id" => null,
                "name" => "Panel administrativo Mundo Cerámico",
                "secret" => null,
                // "secret" => Hk3RU6BPvRIGYXUGlrr4YHiN4Uz8E88PL6nwd3eI,
                "provider" => null,
                "redirect" => "http://localhost:5174/callback",
                "personal_access_client" => "0",
                "password_client" => "0",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => "9ab115c9-3caa-450b-9499-4b130faa8082",
                "user_id" => null,
                "name" => "Mundo Cerámico Password Grant Client",
                "secret" => Hash::make('Ej3MCg5gVvLGPBr2jz3fTnvhyj8XaGu8XgbubDta'),
                "provider" => "users",
                "redirect" => "http://localhost:8000",
                "personal_access_client" => "0",
                "password_client" => "1",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
