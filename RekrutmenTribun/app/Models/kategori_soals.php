<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori_soals extends Model
{
    // protected $table = 'kategori_soals';
    use HasFactory;

    public function soals(){
        return $this->hasMany('App\Models\soals');
    }

}
