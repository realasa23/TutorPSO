<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMasalah extends Model
{
    use HasFactory;

    protected $table = 'laporanmasalah';
    protected $primaryKey = 'idlaporan';

    public $incrementing = false; 
    protected $keyType = 'string'; 

    public $timestamps = false;

    protected $fillable = [
        'idlaporan', 
        'userid', 
        'idsesi', 
        'kategorimasalah', 
        'deskripsimasalah', 
        'statuslaporan'
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