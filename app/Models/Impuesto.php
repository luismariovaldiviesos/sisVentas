<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impuesto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','porcentaje','codigo'];

    // un impuesto pertenece a varios prodcutos
    public function productos(){
        return $this->belongsToMany(Producto::class, 'impuesto_producto');
    }
}
