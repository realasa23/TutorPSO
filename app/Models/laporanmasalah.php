<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMasalah extends Model
{
    protected $table = 'laporanmasalah';
    protected $primaryKey = 'idlaporan';

    protected $fillable = [
        'userid', 'idsesi', 'kategorimasalah', 
        'deskripsimasalah', 'statuslaporan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'idsesi');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'idlaporan');
    }
}
