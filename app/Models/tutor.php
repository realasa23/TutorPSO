<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $table = 'tutor';
    protected $primaryKey = 'idtutor';
    
    // START: BARIS WAJIB UNTUK ID STRING (T01, T02...)
    public $incrementing = false;
    protected $keyType = 'string';
    // END: BARIS WAJIB

    protected $fillable = [
        'pekerjaan', 'deskripsi', 'ratingtutor', 'nama', 'fototutor'
    ];

    public function sesi() {
        return $this->hasMany(Sesi::class, 'idtutor', 'idtutor');
    }

}