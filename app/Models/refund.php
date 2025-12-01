<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $table = 'refund';
    protected $primaryKey = 'idrefund';

    public $incrementing = false; 
    protected $keyType = 'string'; 

    public $timestamps = false; 

    protected $fillable = [
        'idrefund', 
        'idlaporan', 
        'statusrefund', 
        'jumlahpengembalian'
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanMasalah::class, 'idlaporan');
    }
}