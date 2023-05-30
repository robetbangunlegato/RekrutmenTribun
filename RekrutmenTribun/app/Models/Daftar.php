<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lamaran;
class Daftar extends Model
{
    protected $table = 'daftars';
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function lamaran(){
        return $this->belongsTo(Lamaran::class);
    }
    public function wawancara(){
        return $this->hasOne('App\Models\Wawancara');
    }

    use HasFactory;
}
