<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hasil_totals extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function soals()
    {
        return $this->belongsToMany('App\Models\soals')->withPivot(['pilihans_id','poin']);
    }

}
