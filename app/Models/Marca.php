<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    public fucntion productos(){
        return $this->hasMany(Producto::class);
    }

    public function caracteristica(){
        return $this->belongsTo(Caracteristica::class);
    }

}
