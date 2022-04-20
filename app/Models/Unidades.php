<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    // una unidad puede estar en varios productos

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
