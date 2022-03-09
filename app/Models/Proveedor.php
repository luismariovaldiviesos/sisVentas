<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    protected $fillable = ['nombre','ruc','email','direccion','email','telefono'];

       // un producto puede tener varios producots
   public function productos()
   {
        return $this->belongsToMany(Producto::class,'producto_proveedor');
    }
}
