<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Empresa;
use Livewire\Component;

class FacturasController extends Component
{

    // para buscar cliente
    public $buscarCliente, $razonsocial, $tipoidentificacion, $valoridentificacion, $email,
             $telefono, $clientes, $clienteSelected;


    public function render()
    {
        $clientes = null;
        $empresa =  Empresa::all();

        //buscar clientes
        if(strlen($this->buscarCliente) > 0)
        {
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')->get();

        }
        else{
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')->get();

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
