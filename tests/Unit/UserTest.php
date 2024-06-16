<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_user_login(): void
    {
        // Create a user for testing
        $user = User::create([
            "name" => "Test Me",
            "email" => "test@test1.com",
            "password" => Hash::make("12345678"),
        ]);

        // Simulate authentication attempt
        $authenticated = Auth::attempt([
            'email' => 'test@test1.com',
            'password' => '12345678',
        ]);

        // Assert that authentication attempt returns true
        $this->assertTrue($authenticated);

        // Optionally, assert that the authenticated user is instance of User model
        $this->assertInstanceOf(User::class, Auth::user());
    }
}
