<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\user;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_halaman_login_bisa_diakses()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_halaman_register_bisa_diakses()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_halaman_landing_bisa_diakses()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

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
    public function test_login_gagal_email_tidak_terdaftar()
    {
        $response = $this->post('/login', [
            'email'    => 'tidakada@test.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
    public function test_login_gagal_email_kosong()
    {
        $response = $this->post('/login', [
            'email'    => '',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
    public function test_login_gagal_password_kosong()
    {
        $response = $this->post('/login', [
            'email'    => 'user@test.com',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['password']);
    }
}