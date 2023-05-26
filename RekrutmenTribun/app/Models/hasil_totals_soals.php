<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_totals_soals extends Model
{
    use HasFactory;

    public function hasil_totals(){
        return $this->hasOne('App\Models\hasil_totals');
    }
}
