<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'idkategori';

    protected $fillable = [
        'namakategori'
    ];

    public function matakuliah()
    {
        return $this->hasMany(Matakuliah::class, 'idkategori');
    }
}