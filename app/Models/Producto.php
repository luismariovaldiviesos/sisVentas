<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','barcode','costo','precio','stock','alertas','categoria_id'];


    public function categoria()
	{
		return $this->belongsTo(Categoria::class);
	}

     // un producto puede tener varios impuestos
   public function impuestos()
   {
        return $this->belongsToMany(Impuesto::class,'impuesto_producto');
    }

    public function ventas()
	{
		return $this->hasMany(SaleDetail::class);
	}

      // un producto puede tener varios proveedores
   public function proveedores()
   {
        return $this->belongsToMany(Proveedor::class,'productos_proveedor');
    }

    // detalles ingresos
    public function detalles ()
    {
        return $this->hasMany(DetalleIngreso::class);
    }





}
