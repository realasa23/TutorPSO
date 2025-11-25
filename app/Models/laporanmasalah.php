<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class laporanmasalah extends Model
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
}