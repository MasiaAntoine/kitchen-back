<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_be_created_with_valid_data()
    {
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }

    public function test_user_password_is_hidden_from_serialization()
    {
        $user = User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => Hash::make('password123'),
        ]);

        $userArray = $user->toArray();
        
        $this->assertArrayNotHasKey('password', $userArray);
        $this->assertArrayNotHasKey('remember_token', $userArray);
    }

    public function test_user_password_is_hashed()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertNotEquals('password123', $user->password);
    }

    public function test_user_email_verified_at_is_casted_to_datetime()
    {
        $user = User::create([
            'name' => 'Verified User',
            'email' => 'verified@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => '2024-01-15 10:30:00',
        ]);

        // Vérifier que le cast fonctionne après sauvegarde
        $user->email_verified_at = '2024-01-15 10:30:00';
        $user->save();
        
        $this->assertInstanceOf(\Carbon\Carbon::class, $user->fresh()->email_verified_at);
        $this->assertEquals('2024-01-15 10:30:00', $user->fresh()->email_verified_at->format('Y-m-d H:i:s'));
    }

    public function test_user_can_be_updated()
    {
        $user = User::create([
            'name' => 'Original Name',
            'email' => 'original@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user->update([
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);

        $this->assertEquals('Updated Name', $user->fresh()->name);
        $this->assertEquals('updated@example.com', $user->fresh()->email);
    }
}
