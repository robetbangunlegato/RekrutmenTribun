<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    public function daftar(){
        return $this->belongsTo('App\Models\Daftar');
    }
    use HasFactory;

}
