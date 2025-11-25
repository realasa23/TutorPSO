<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $primaryKey = 'idpesanan';

    protected $fillable = [
        'idsesi', 'userid', 'istrial', 'biaya', 
        'statuspembayaran', 'status'
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
