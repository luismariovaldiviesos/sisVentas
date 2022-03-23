<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Cliente;

class ClientesController extends Component
{
    use WithPagination;

    public $razonsocial, $tipoidentificacion ,$valoridentificacion,$telefono,$direccion,$email,$selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName ='Clientes';
        $this->status ='Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        $data = Cliente::where('razonsocial', 'like', '%' . $this->search . '%')
                ->select('*')->orderBy('id','asc')->paginate($this->pagination);
    else
       $data = Cliente::select('*')->orderBy('id','asc')->paginate($this->pagination);
        return view('livewire.clientes.component', [
            'data' => $data
            ]
        )->extends('layouts.theme.app')
        ->section('content');;
    }


    public function resetUI()
    {
        $this->razonsocial ='';
        $this->tipoidentificacion ='';
        $this->valoridentificacion ='';
        $this->direccion ='';
        $this->telefono ='';
        $this->email='';
        $this->search ='';
        $this->status ='Elegir';
        $this->selected_id =0;
        $this->resetValidation();
        $this->resetPage();
    }


    public function edit(Cliente $cliente)
    {
        $this->selected_id = $cliente->id;
        $this->razonsocial = $cliente->razonsocial;
        $this->tipoidentificacion = $cliente->tipoidentificacion;
        $this->valoridentificacion = $cliente->valoridentificacion;
        $this->telefono = $cliente->telefono;
        $this->direccion = $cliente->direccion;
        $this->email = $cliente->email;
        $this->emit('show-modal','open!');

    }

    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {

        $rules =[
            'razonsocial' => 'required|min:3',
            'tipoidentificacion' => 'required',
            'valoridentificacion' => 'required|unique:clientes',
            'telefono' => 'required',
            'email' => 'required|unique:clientes|email'
        ];

        $messages =[
            'razonsocial.required' => 'Ingresa la razon social del cliente',
            'razonsocial.min' => 'LA razon social del cliente debe tener al menos 3 caracteres',
            'tipoidentificacion.required' => 'Ingresa tipo de identificación',
            'valoridentificacion.required' => 'Ingresa valor identificacion o cédula del cliente',
            'valoridentificacion.unique' => 'El Ruc o Cedula ya existe en el sistema',
            'telefono.required' => 'Teléfono del cliente es requerido',
            'email.required' => 'Email del cliente es requerido',
            'email.unique' => 'El email ya existe en el sistema',
            'email.email' => 'El email no tiene el formato correcto'
        ];
        $this->validate($rules, $messages);
        $cliente = Cliente::create([
            'razonsocial' => $this->razonsocial,
            'tipoidentificacion' => $this->tipoidentificacion,
            'valoridentificacion' => $this->valoridentificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email
        ]);

        $this->resetUI();
        $this->emit('cliente-added','Usuario Registrado');
    }


    public function Update()
    {

        $rules =[
            'email' => "unique:clientes,email,{$this->selected_id}",
            'valoridentificacion' => "unique:clientes,valoridentificacion,{$this->selected_id}",
            'razonsocial' => 'required|min:3',
            'tipoidentificacion' => 'required',
            'telefono' => 'required'

        ];

        $messages =[
            'razonsocial.required' => 'Ingresa la razon social del cliente',
            'razonsocial.min' => 'LA razon social del cliente debe tener al menos 3 caracteres',
            'tipoidentificacion.required' => 'Ingresa tipo de identificación',
            'valoridentificacion.unique' => 'El Ruc o Cedula ya existe en el sistema',
            'telefono.required' => 'Teléfono del cliente es requerido',
            'email.unique' => 'El email ya existe en el sistema'
        ];

        $this->validate($rules, $messages);

        $cliente = Cliente::find($this->selected_id);
        //dd($cliente);
        $cliente->update([
            'razonsocial' => $this->razonsocial,
            'tipoidentificacion' => $this->tipoidentificacion,
            'valoridentificacion' => $this->valoridentificacion,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email
        ]);
        $this->resetUI();
        $this->emit('cliente-updated','Usuario Actualizado');

    }

    public function destroy(Cliente $cliente)
    {
       $cliente->delete();
       $this->resetUI();
    	$this->emit('cliente-deleted', 'Cliente  Eliminado');
    }


}
