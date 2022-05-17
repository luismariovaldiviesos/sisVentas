<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = ['porcentaje'];

     // un descuento esta en muchos productos
     public function productos(){
        return $this->hasMany(Producto::class);
    }
}

