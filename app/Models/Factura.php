<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Empresa;


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


    public  function secuencial ()
    {
        $fac = Factura::latest('secuencial')->first(); // ultimo ingresao  registro por el campo secuencial
        if ($fac == null) {
            $fac  = "000000001";
        }
        else{
           $sec_bd=  $fac->secuencial; // secuencial base de datos =  a
           $fac = $sec_bd+1; // se suma uno al secuencial
           $tamano = 9;  // max de ceros a la izquierda
           $fac = substr(str_repeat(0,$tamano).$fac,-$tamano); // se lelna de ceros a la izq
        }
        return $fac;
    }

    public function  fechaFactura ()
    {
        $fechafactura =  Carbon::now()->format('d-m-Y');
        return $fechafactura;
    }

    public function codigoDoc()
    {
        $codigo  = "01";
        return $codigo;
    }

    // empresa
   public function empresa()
   {
        $empresa =  Empresa::get();
        return $empresa;
   }



   public function serie()
   {
       $empresa =  $this->empresa();
       $establecimiento =  $empresa[0]->estab;
       $puntoEmi  =  $empresa[0]->ptoEmi;
        $serie  = $establecimiento.$puntoEmi;
        return $serie;
   }

   public  function tipoEmision()
   {
    $empresa =  $this->empresa();
    $tipoEmision =  $empresa[0]->tipoEmision;
    return $tipoEmision;
   }









    /*  max 49
    ddmmaaaa  ok
    tipocomprobante  01
        ruc
        ambiente	serie	secuencial
        codigo nuemerici
        tipo emision
        digito verificador
    */


}
