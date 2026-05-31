<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = 'sesi';
    protected $primaryKey = 'idsesi';
    
    // Gak perlu public $incrementing = false; dan protected $keyType = 'string'; karena id kita angka!

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
}