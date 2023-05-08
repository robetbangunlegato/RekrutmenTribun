<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftar extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function lamaran(){
        return $this->belongsTo('App\Models\Lamaran');
    }
    public function wawancara(){
        return $this->hasOne('App\Models\Wawancara');
    }
    use HasFactory;
}
