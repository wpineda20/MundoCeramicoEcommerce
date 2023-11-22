<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::insert([
            [
                'id' => 1,
                'name' => 'Reservada',
            ],
            [
                'id' => 2,
                'name' => 'Facturada',
            ],
            [
                'id' => 3,
                'name' => 'Anulada',
            ],

        ]);
    }
}
