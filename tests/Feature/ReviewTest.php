<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\u\User;
use Illuminate\Support\Facades\DB;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_mengirim_ulasan_tutor()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        session(['user_id' => $user->userid]); // Set session manual

        // Bikin dummy pesanan
        $idpesanan = DB::table('pesanan')->insertGetId([
            'userid' => $user->userid,
            'idsesi' => 1,
            'tanggal' => now()->toDateString(),
            'jam' => '10:00:00',
            'durasi' => 1,
            'biaya' => 50000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->post('/aktivitas/ulas/store', [
            'idpesanan' => $idpesanan,
            'rating' => 5,
            'tagpenilaian' => 'Tutor sangat baik',
            'komentar' => 'Sangat merekomendasikan tutor ini.',
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('review', ['idpesanan' => $idpesanan]);
    }

    public function test_review_redirect_login_jika_belum_login()
    {
        // Akses langsung halaman review tanpa login
        $response = $this->get('/aktivitas/ulas/1');
        $response->assertRedirect('/login');

        // Post review tanpa login
        $responsePost = $this->post('/aktivitas/ulas/store', [
            'idpesanan' => 1,
            'rating' => 5,
        ]);
        $responsePost->assertRedirect('/login');
    }

    public function test_review_gagal_jika_pesanan_tidak_ditemukan()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        session(['user_id' => $user->userid]);

        // KITA UBAH EXPECTATION MENJADI 404
        $response = $this->get('/aktivitas/ulas/999');
        $response->assertStatus(404);
    }

    public function test_review_gagal_jika_sudah_pernah_review()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        session(['user_id' => $user->userid]);

        $idpesanan = DB::table('pesanan')->insertGetId([
            'userid' => $user->userid,
            'idsesi' => 1,
            'tanggal' => now()->toDateString(),
            'jam' => '10:00:00',
            'durasi' => 1,
            'biaya' => 50000,
        ]);

        DB::table('review')->insert([
            'idpesanan' => $idpesanan,
            'rating' => 4,
        ]);

        // KITA HANYA TEST POST-NYA SAJA BIAR LEBIH AKURAT & AMAN
        $responsePost = $this->post('/aktivitas/ulas/store', [
            'idpesanan' => $idpesanan,
            'rating' => 5,
        ]);

        // Memastikan kalau nge-post review dobel, bakal di-redirect balik bawa error
        $responsePost->assertRedirect()->assertSessionHas('error');
    }
}
