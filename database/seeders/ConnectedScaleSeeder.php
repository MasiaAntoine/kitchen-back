<?php

namespace Database\Seeders;

use App\Models\ConnectedScale;
use Illuminate\Database\Seeder;

class ConnectedScaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Créer quelques balances connectées d'exemple
        ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Cuisine',
            'last_update' => now(),
        ]);

        ConnectedScale::create([
            'mac_address' => 'BB:CC:DD:EE:FF:AA',
            'name' => 'Balance Salle de Bain',
            'last_update' => now()->subMinutes(10),
        ]);

        ConnectedScale::create([
            'mac_address' => 'CC:DD:EE:FF:AA:BB',
            'name' => 'Balance Garage',
            'last_update' => null,
        ]);
    }
}
