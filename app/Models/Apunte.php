<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paso;

class Apunte extends Model
{
    protected  $fillable = ['titulo', 'explicacion', 'imagen', 'link' ];
    use HasFactory;


    public function pasos(){
        return $this->hasMany('App\Models\Paso');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    
}
