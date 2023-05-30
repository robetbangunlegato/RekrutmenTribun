<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    protected $table = 'lamarans';
    public function daftar(){
        return $this->hasMany('App\Models\Daftar');
    }
    use HasFactory;
}
