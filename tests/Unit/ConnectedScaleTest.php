<?php

namespace Tests\Unit;

use App\Models\ConnectedScale;
use App\Models\Ingredient;
use Tests\TestCase;
use Carbon\Carbon;
use Tests\Traits\ConfigureSqliteDatabase;

class ConnectedScaleTest extends TestCase
{
    use ConfigureSqliteDatabase;

    public function test_connected_scale_can_be_created_with_valid_data()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Cuisine',
            'last_update' => now(),
        ]);

        $this->assertInstanceOf(ConnectedScale::class, $connectedScale);
        $this->assertEquals('AA:BB:CC:DD:EE:FF', $connectedScale->mac_address);
        $this->assertEquals('Balance Cuisine', $connectedScale->name);
    }

    public function test_connected_scale_is_online_when_last_update_is_recent()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Récente',
            'last_update' => now()->subMinutes(2), // Mise à jour il y a 2 minutes
        ]);

        $this->assertTrue($connectedScale->isOnline());
    }

    public function test_connected_scale_is_offline_when_last_update_is_old()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Ancienne',
            'last_update' => now()->subMinutes(10), // Mise à jour il y a 10 minutes
        ]);

        $this->assertFalse($connectedScale->isOnline());
    }

    public function test_connected_scale_is_offline_when_no_last_update()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Sans Mise à Jour',
            'last_update' => null,
        ]);

        $this->assertFalse($connectedScale->isOnline());
    }

    public function test_connected_scale_has_ingredient_relationship()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance avec Ingredient',
            'last_update' => now(),
        ]);

        $ingredient = Ingredient::factory()->create([
            'connected_scale_id' => $connectedScale->id,
        ]);

        $this->assertInstanceOf(Ingredient::class, $connectedScale->ingredient);
        $this->assertEquals($ingredient->id, $connectedScale->ingredient->id);
    }

    public function test_connected_scale_last_update_is_casted_to_datetime()
    {
        $connectedScale = ConnectedScale::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Test',
            'last_update' => '2024-01-15 10:30:00',
        ]);

        $this->assertInstanceOf(Carbon::class, $connectedScale->last_update);
        $this->assertEquals('2024-01-15 10:30:00', $connectedScale->last_update->format('Y-m-d H:i:s'));
    }
}
