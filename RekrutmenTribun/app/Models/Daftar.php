<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Daftar extends Model
{
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    use HasFactory;
}
