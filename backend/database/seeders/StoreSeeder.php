<?php

namespace Database\Seeders;

use App\Models\Localization;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $localizationStore1 = Localization::create([
            'name' => 'Tienda 1',
            'address' => 'Tienda en direccion tal 1',
            'latitude' =>  13.709369719911635,
            'longitude' =>  -89.19301713010249,
        ]);
        $store1 = Store::create([
            'name' => 'Tienda 1',
            'localization_id' => $localizationStore1->id,
        ]);

        $localizationStore2 = Localization::create([
            'name' => 'Tienda 2',
            'address' => 'Tienda en direccion tal 2',
            'latitude' =>  13.709369719911635,
            'longitude' =>  -89.19301713010249,
        ]);
        $store2 = Store::create([
            'name' => 'Tienda 2',
            'localization_id' => $localizationStore2->id,
        ]);
    }
}
