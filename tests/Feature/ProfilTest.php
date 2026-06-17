<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProfilTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_login_bisa_melihat_halaman_profil()
    {
        // 1. Setup User Login
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Akses halaman profil dan IKUTI redirect-nya
        $response = $this->followingRedirects()->get('/profile');

        // 3. Memastikan hasil akhirnya berhasil dimuat (HTTP 200 OK)
        $response->assertStatus(200);
    }

    public function test_user_belum_login_tidak_bisa_melihat_profil()
    {
        // Akses profil tanpa login
        $response = $this->get('/profile');

        // Memastikan sistem menolak dan mengalihkan (redirect 302) ke halaman login
        $response->assertStatus(302);
    }
}
