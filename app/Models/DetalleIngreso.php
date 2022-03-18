<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;
    protected $table = 'detalle_ingreso';

    protected $fillable = ['ingreso_id','producto_id','cantidad','preciocompra','total'];
}
