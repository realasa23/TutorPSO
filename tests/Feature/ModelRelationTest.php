<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Pesanan;
use App\Models\Review;
use App\Models\Sesi;
use App\Models\Tutor;
use App\Models\User;
use App\Models\LaporanMasalah;
use App\Models\Matakuliah;

class ModelRelationTest extends TestCase
{
    // --- JOBDESK KAMU ---
    public function test_pesanan_relations()
    {
        $pesanan = new Pesanan();
        $this->assertNotNull($pesanan->user());
        $this->assertNotNull($pesanan->sesi());
        $this->assertNotNull($pesanan->review());
        $this->assertNotNull($pesanan->laporanMasalah());
    }

    public function test_review_relations()
    {
        $review = new Review();
        $this->assertNotNull($review->pesanan());
    }

    public function test_sesi_relations()
    {
        $sesi = new Sesi();
        $this->assertNotNull($sesi->pesanan());
        $this->assertNotNull($sesi->tutor());
        $this->assertNotNull($sesi->matakuliah());
    }

    public function test_tutor_relations()
    {
        $tutor = new Tutor();
        $this->assertNotNull($tutor->sesi());
    }

    // --- JOBDESK TEMANMU ---
    public function test_user_relations()
    {
        $user = new User();
        $this->assertNotNull($user->pesanan());
        $this->assertNotNull($user->laporanMasalah());
    }

    public function test_laporan_masalah_relations()
    {
        $laporan = new LaporanMasalah();
        $this->assertNotNull($laporan->user());
        $this->assertNotNull($laporan->pesanan());
        $this->assertNotNull($laporan->refund());
    }

    public function test_matakuliah_relations()
    {
        $matakuliah = new Matakuliah();
        $this->assertNotNull($matakuliah->kategori());
        $this->assertNotNull($matakuliah->sesi());
    }
}
