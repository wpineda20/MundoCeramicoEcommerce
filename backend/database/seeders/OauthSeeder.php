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
                "id" => "9956ed49-c9a7-4fe3-9518-715c3d850a30",
                "user_id" => null,
                "name" => "Mundo Cerámico Auth",
                "secret" => null,
                "provider" => null,
                "redirect" => "http://localhost:5173/callback,https://lobotech.sv/callback",
                "personal_access_client" => "0",
                "password_client" => "0",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => "9975aca8-5623-47d3-9c12-a9138028241a",
                "user_id" => null,
                "name" => "Panel administrativo Mundo Cerámico",
                "secret" => null,
                "provider" => null,
                "redirect" => "http://localhost:5174/callback,https://admin.lobotech.sv/callback",
                "personal_access_client" => "0",
                "password_client" => "0",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "id" => "9964dfb3-a049-453a-967c-208a66d8eec4",
                "user_id" => null,
                "name" => "Mundo Cerámico Password Grant Client",
                "secret" => Hash::make('b7uKerrXIMsHuz8zHXlwnQ5d3Ty4z5fkBqZ8Rqny'),
                "provider" => "users",
                "redirect" => "http://localhost",
                "personal_access_client" => "0",
                "password_client" => "1",
                "revoked" => "0",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
