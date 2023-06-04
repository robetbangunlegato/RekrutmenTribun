<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lowongans extends Model
{
    
    public function daftar(){
        return $this->hasMany('App\Models\Daftar');
    }
    use HasFactory;
}
