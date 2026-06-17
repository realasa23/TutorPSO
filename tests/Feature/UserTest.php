<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private function createUser(array $override = []): object
    {
        $userId = DB::table('user')->insertGetId(array_merge([
            'username'   => 'TestUser',
            'email'      => 'test@test.com',
            'password'   => Hash::make('password123'),
            'nomorhp'    => '08123456789',
            'kuotatrial' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ], $override));

        return DB::table('user')->where('userid', $userId)->first();
    }

    public function test_home_tampil_untuk_user_login()
    {
        $user = $this->createUser();

        $response = $this->withSession(['user_id' => $user->userid])
            ->get('/home');

        $response->assertStatus(200);
    }

    public function test_home_redirect_login_jika_belum_login()
    {
        $response = $this->get('/home');
        $response->assertRedirect('/login');
    }

    public function test_profil_tampil_untuk_user_login()
    {
        $user = $this->createUser();

        $response = $this->withSession(['user_id' => $user->userid])
            ->get('/profile');

        $response->assertStatus(200);
    }

    public function test_profil_redirect_login_jika_belum_login()
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    }

    public function test_update_foto_profil_berhasil()
    {
        Storage::fake('public');
        $user = $this->createUser();

        $file = UploadedFile::fake()->create('foto.jpg', 100, 'image/jpeg');

        $response = $this->withSession(['user_id' => $user->userid])
            ->post('/profile/update', [
                'fotoprofil' => $file,
            ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_update_profil_tanpa_foto_tetap_berhasil()
    {
        $user = $this->createUser();

        $response = $this->withSession(['user_id' => $user->userid])
            ->post('/profile/update', []);

        $response->assertRedirect();
    }

    public function test_update_profil_redirect_login_jika_belum_login()
    {
        $response = $this->post('/profile/update', []);
        $response->assertRedirect('/login');
    }

    public function test_update_profil_gagal_file_bukan_gambar()
    {
        $user = $this->createUser();

        $file = UploadedFile::fake()->create('doc.pdf', 100, 'application/pdf');

        $response = $this->withSession(['user_id' => $user->userid])
            ->post('/profile/update', [
                'fotoprofil' => $file,
            ]);

        $response->assertSessionHasErrors(['fotoprofil']);
    }


public function test_logout_berhasil_hapus_session()
    {
        $user = $this->createUser();

        $response = $this->withSession(['user_id' => $user->userid])
            ->post('/logout');                    // ← ganti dari ->get() ke ->post()

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}