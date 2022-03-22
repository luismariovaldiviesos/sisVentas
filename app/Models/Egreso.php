<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    protected $fillable = ['proveedor_id','user_id','tipoidentificador','valoridentificador','totalegreso','observaciones'];


     // un ingreso pertenece a un usuario (que ingresa)
     public function user()
     {
         return $this->belongsTo(User::class);
     }

     public function proveedor()
     {
         return $this->belongsTo(Proveedor::class);
     }


     // un ibngreso tiene variuos detalles

    public function detalles ()
    {
        return $this->hasMany(DetalleEgreso::class);
    }

}
