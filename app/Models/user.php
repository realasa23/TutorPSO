<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user extends Authenticatable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'userid';

    protected $fillable = [
        'username', 'email', 'password', 'nomorhp', 'fotoprofil', 'kuotatrial'
    ];

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'userid');
    }

    public function laporanMasalah()
    {
        return $this->hasMany(LaporanMasalah::class, 'userid');
    }
}
