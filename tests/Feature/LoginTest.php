<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_berhasil_dengan_kredensial_valid()
    {
        User::factory()->create([
            'email'    => 'user@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'user@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/home');
    }

    public function test_login_gagal_password_salah()
    {
        User::factory()->create([
            'email'    => 'user@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'user@test.com',
            'password' => 'salahpassword',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertGuest();
    }
}