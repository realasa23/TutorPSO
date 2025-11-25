<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    protected $table = 'review';
    protected $primaryKey = 'idreview';

    protected $fillable = [
        'idpesanan', 'rating', 'tagpenilaian', 
        'komentar', 'tanggalreview'
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'idpesanan');
    }
}
