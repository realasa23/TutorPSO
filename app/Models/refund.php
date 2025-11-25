<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'idrefund';

    protected $fillable = [
        'idlaporan', 'statusrefund', 'jumlahpengembalian'
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanMasalah::class, 'idlaporan');
    }
}
