<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Tutor;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_bisa_mengirim_ulasan_tutor()
    {
        // 1. Setup User Login
        $user = User::factory()->create();
        $this->actingAs($user);

        // 2. Setup Data Kategori dan Tutor Dummy
        $kategori = Kategori::create([
            'namakategori' => 'Pemrograman Web'
        ]);

        $tutor = Tutor::create([
            'nama' => 'Sasha',
            'kategori_id' => $kategori->id,
            'harga' => 50000
        ]);

        // 3. Action: Kirim review
        // PENTING: Jika di web.php rutenya bukan '/review', ganti URL di bawah ini!
        // Jika rute aslinya misal '/ulasan', ubah '/review' di bawah ini:
        $response = $this->post('/aktivitas/ulas/store', [
            'tutor_id' => $tutor->id,
            'rating' => 5,
            'komentar' => 'Penjelasannya sangat mudah dipahami dan sabar banget!',
        ]);

        // 4. Assert: Pastikan berhasil redirect (302)
        $response->assertStatus(302);
    }
}
