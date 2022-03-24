<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable = [

        'cliente_id','user_id','codDoc','claveAcceso','secuencial','estado'
            ];



    // una factura pertenece a un cliente

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // una factura pertenece a un usuario

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
