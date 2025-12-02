<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'idpesanan';
    public $timestamps = false;
    public $incrementing = true;
    protected $keyType = 'int';


    protected $fillable = [
        'idsesi',
        'userid',
        'tanggal',
        'jam',
        'istrial',
        'statuspembayaran',
        'status',
    ];

    protected $casts = [
        'istrial' => 'boolean',
        'tanggal' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'idsesi');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'idpesanan');
    }
}
