<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['razonsocial','tipoidentificacion','valoridentificacion','direccion','email','telefono'];

     // un  cliente pued estar en muchas facturas
     public function facturas()
     {
         return $this->hasMany(Factura::class);
     }

}
