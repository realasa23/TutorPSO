<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
<<<<<<< HEAD
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
=======
    protected $table = 'refund';
    protected $primaryKey = 'idrefund';

    protected $fillable = [
        'idlaporan', 'statusrefund', 'jumlahpengembalian'
>>>>>>> Nailah-Adlina
    ];

    public function laporan()
    {
        return $this->belongsTo(LaporanMasalah::class, 'idlaporan');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> Nailah-Adlina
