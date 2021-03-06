<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','barcode','costo','precio','pvp','stock','alertas','categoria_id','unidad_id', 'descuento_id'];


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

     // unidad de medida
     public function unidad ()
     {
         return $this->belongsTo(Unidades::class);
     }

       // un producto tiene un descuento
   public function descuento()
   {
        return $this->belongsTo(Descuento::class);
    }


    public function calculaDescuento()
    {
        $porcentaje = $this->descuento->porcentaje;
        $valorDescuento =  ($this->precio * $porcentaje) /100;
        return $valorDescuento;
    }


    public function calculaImpuestos()
    {
        $impuestos = $this->impuestos;
        return $impuestos;
    }







}
