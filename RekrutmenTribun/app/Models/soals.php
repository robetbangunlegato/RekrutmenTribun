<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soals extends Model
{
    use HasFactory;

    public function kategori_soals(){
        return $this->belongsTo('App\Models\kategori_soals');
    }

    public function pilihans(){
        return $this->hasMany('App\Models\pilihans');
    }
}
