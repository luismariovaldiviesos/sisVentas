<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    use HasFactory;

    protected $fillable = ['porcentaje'];

     // un descuento pertenece a varios prodcutos
     public function productos(){
        return $this->belongsToMany(Producto::class, 'descuento_producto');
    }
}

