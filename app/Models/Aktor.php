<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktor extends Model
{
    use HasFactory;

    public function film()
    {
        return $this->belongToMany(Film::class,'aktor_film','id_aktor','id_film');
    }
}
