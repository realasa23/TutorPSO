<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
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

<<<<<<< HEAD
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'user';
    protected $primaryKey = 'userid';

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'userid');
    }

=======
>>>>>>> Nailah-Adlina
    public function laporanMasalah()
    {
        return $this->hasMany(LaporanMasalah::class, 'userid');
    }
}
