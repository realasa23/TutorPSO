<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';        
    protected $primaryKey = 'idreview'; 

    public $incrementing = false;       
    protected $keyType = 'string';      
    public $timestamps = false;         

    protected $fillable = [
        'idreview',      
        'idpesanan',     
        'rating', 
        'tagpenilaian', 
        'komentar', 
        'tanggalreview'
    ];
}