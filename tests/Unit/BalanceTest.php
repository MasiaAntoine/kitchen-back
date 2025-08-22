<?php

namespace Tests\Unit;

use App\Models\Balance;
use App\Models\Ingredient;
use Tests\TestCase;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BalanceTest extends TestCase
{
    use RefreshDatabase;

    public function test_balance_can_be_created_with_valid_data()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Cuisine',
            'last_update' => now(),
        ]);

        $this->assertInstanceOf(Balance::class, $balance);
        $this->assertEquals('AA:BB:CC:DD:EE:FF', $balance->mac_address);
        $this->assertEquals('Balance Cuisine', $balance->name);
    }

    public function test_balance_is_online_when_last_update_is_recent()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Récente',
            'last_update' => now()->subMinutes(2), // Mise à jour il y a 2 minutes
        ]);

        $this->assertTrue($balance->isOnline());
    }

    public function test_balance_is_offline_when_last_update_is_old()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Ancienne',
            'last_update' => now()->subMinutes(10), // Mise à jour il y a 10 minutes
        ]);

        $this->assertFalse($balance->isOnline());
    }

    public function test_balance_is_offline_when_no_last_update()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Sans Mise à Jour',
            'last_update' => null,
        ]);

        $this->assertFalse($balance->isOnline());
    }

    public function test_balance_has_ingredient_relationship()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance avec Ingredient',
            'last_update' => now(),
        ]);

        $ingredient = Ingredient::factory()->create([
            'balance_id' => $balance->id,
        ]);

        $this->assertInstanceOf(Ingredient::class, $balance->ingredient);
        $this->assertEquals($ingredient->id, $balance->ingredient->id);
    }

    public function test_balance_last_update_is_casted_to_datetime()
    {
        $balance = Balance::create([
            'mac_address' => 'AA:BB:CC:DD:EE:FF',
            'name' => 'Balance Test',
            'last_update' => '2024-01-15 10:30:00',
        ]);

        $this->assertInstanceOf(Carbon::class, $balance->last_update);
        $this->assertEquals('2024-01-15 10:30:00', $balance->last_update->format('Y-m-d H:i:s'));
    }
}
