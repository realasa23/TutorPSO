<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tutor extends Model
{
    protected $table = 'tutor';
    protected $primaryKey = 'idtutor';

    protected $fillable = [
        'pekerjaan', 'deskripsi', 'ratingtutor', 'nama'
    ];

    public function sesi() {
    return $this->hasMany(Sesi::class, 'idtutor', 'idtutor');
    }

}
