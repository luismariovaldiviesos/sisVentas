<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Factura;
use Carbon\Carbon;
use Livewire\Component;

class FacturasController extends Component
{

    // para buscar cliente
    public $buscarCliente, $razonsocial, $tipoidentificacion, $valoridentificacion, $email,
             $telefono, $clientes, $clienteSelected;

    // para cabecera factura
    //codDoc claveAcceso  secuencial
    // fechaEmision  - > created_at
    public $fechafactura, $secuencial, $claveAcceso, $codDoc, $serie, $tipoEmision ;

    // para el carrito
    public $total =10, $itemsQuantity =1, $cart = [], $valorIngresado;




    public function  mount()
    {
        $fact  = new Factura();
        $this->fechafactura =  Carbon::now()->format('d-m-Y');
        $this->claveAcceso = $fact->claveAcceso();
        $this->secuencial = $fact->secuencial();
       //dd($this->claveAcceso);

    }









    public function render()
    {

        $clientes = null;
        $empresa =  Empresa::all();

        //buscar clientes
        if(strlen($this->buscarCliente) > 0)
        {
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')
                                ->orWhere('razonsocial','like', '%' . $this->buscarCliente . '%')->get();

        }
        else{
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')
                                ->orWhere('razonsocial','like', '%' . $this->buscarCliente . '%')->get();
        }

        $this->clientes = $clientes;
       // dd($clientes);




        return view('livewire.facturas.component', compact('empresa'))->extends('layouts.theme.app')
		->section('content');

    }


    public  function  mostrarCliente($cliente)
    {
        $this->clientes = '';
        $this->buscarCliente = '';
        $clienteJson = json_decode($cliente);
        $this->razonsocial =  $clienteJson->razonsocial;
        $this->tipoidentificacion =  $clienteJson->tipoidentificacion;
        $this->valoridentificacion =  $clienteJson->valoridentificacion;
        $this->email =  $clienteJson->email;
        $this->telefono =  $clienteJson->telefono;
    }

    public function limpiarCliente()
    {
        $this->razonsocial =  "";
        $this->tipoidentificacion =  "";
        $this->valoridentificacion =  "";
        $this->email = "";
        $this->telefono =  "";
    }
}
