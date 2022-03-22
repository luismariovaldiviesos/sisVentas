<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEgreso extends Model
{
    use HasFactory;

    protected $table = 'detalle_egreso';
    protected $fillable = ['egreso_id','producto_id','cantidad','preciocompra','total'];

    // un detalle pertencee a un egreso

    public function egreso ()
    {
        return $this->belongsTo(Egreso::class);
    }
}
