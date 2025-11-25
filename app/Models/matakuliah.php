<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'idmatkul';
    
    // START: BARIS WAJIB UNTUK ID STRING (M01, M02...)
    public $incrementing = false;
    protected $keyType = 'string';
    // END: BARIS WAJIB

    protected $fillable = [
        'idkategori', 'namamatkul'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    public function sesi()
    {
        return $this->hasMany(Sesi::class, 'idmatkul', 'idmatkul'); // Tambahkan owner key
    }
}