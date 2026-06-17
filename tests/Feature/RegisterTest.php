<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_melihat_halaman_register()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_register_berhasil_dengan_data_valid()
    {
        $response = $this->post('/register', [
            'username'              => 'UserTest',
            'email'                 => 'test@test.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            'nomorhp'               => '08123456789',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseHas('user', ['email' => 'test@test.com']);
    }

    public function test_register_gagal_email_sudah_dipakai()
    {
        DB::table('user')->insert([
            'username'    => 'UserLama',
            'email'       => 'test@test.com',
            'password'    => Hash::make('password123'),
            'nomorhp'     => '08123456789',
            'kuotatrial'  => 0,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        $response = $this->post('/register', [
            'username'              => 'UserBaru',
            'email'                 => 'test@test.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            'nomorhp'               => '08111111111',
        ]);

        $response->assertSessionHasErrors(['email']);
    }

    public function test_register_gagal_password_tidak_cocok()
    {
        $response = $this->post('/register', [
            'username'              => 'UserTest',
            'email'                 => 'test@test.com',
            'password'              => 'password123',
            'password_confirmation' => 'salah',
            'nomorhp'               => '08123456789',
        ]);

        $response->assertSessionHasErrors(['password']);
    }

    public function test_register_gagal_nomorhp_kosong()
    {
        $response = $this->post('/register', [
            'username'              => 'UserTest',
            'email'                 => 'test@test.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            'nomorhp'               => '',
        ]);

        $response->assertSessionHasErrors(['nomorhp']);
    }
}