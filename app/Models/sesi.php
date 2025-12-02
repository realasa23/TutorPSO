<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'idsesi';
    
    // START: BARIS WAJIB UNTUK ID STRING (S01, S02...)
    public $incrementing = false;
    protected $keyType = 'string';
    // END: BARIS WAJIB

    protected $fillable = [
        'idmatkul', 'idtutor',
        'harga', 'tanggal', 'jam',
        'filemateri', 'zoomtutor', 'rekamankelas'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'idsesi');
    }

    public function tutor() {
        return $this->belongsTo(Tutor::class, 'idtutor', 'idtutor');
    }

    public function matakuliah() {
        return $this->belongsTo(Matakuliah::class, 'idmatkul', 'idmatkul');
    }

    public function laporanMasalah()
    {
        return $this->hasMany(LaporanMasalah::class, 'idsesi');
    }
}