<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class matakuliah extends Model
{
    protected $table = 'matakuliah';
    protected $primaryKey = 'idmatkul';

    protected $fillable = [
        'idkategori', 'namamatkul'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'idkategori');
    }

    public function sesi()
    {
        return $this->hasMany(Sesi::class, 'idmatkul');
    }
}
