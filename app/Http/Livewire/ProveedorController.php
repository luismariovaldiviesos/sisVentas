<?php

namespace App\Http\Livewire;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;


class ProveedorController extends Component
{

    use WithPagination;

    public $nombre,$ruc,$telefono,$direccion,$email,$selected_id;
    public $pageTitle, $componentName, $search;
    private $pagination = 10;


    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function mount()
    {
        $this->pageTitle ='Listado';
        $this->componentName ='Proveedores';
        $this->status ='Elegir';
    }

    public function render()
    {
        if(strlen($this->search) > 0)
        $data = Proveedor::where('nombre', 'like', '%' . $this->search . '%')
                ->select('*')->orderBy('id','asc')->paginate($this->pagination);
    else
       $data = Proveedor::select('*')->orderBy('id','asc')->paginate($this->pagination);
        return view('livewire.proveedores.component', [
            'data' => $data
            ]
        )->extends('layouts.theme.app')
        ->section('content');;
    }

    public function resetUI()
    {
        $this->nombre ='';
        $this->ruc ='';
        $this->direccion ='';
        $this->telefono ='';
        $this->email='';
        $this->search ='';
        $this->status ='Elegir';
        $this->selected_id =0;
        $this->resetValidation();
        $this->resetPage();
    }

    public function Edit(Proveedor $proveedor)
    {
        $this->selected_id = $proveedor->id;
        $this->nombre = $proveedor->nombre;
        $this->ruc = $proveedor->ruc;
        $this->telefono = $proveedor->telefono;
        $this->direccion = $proveedor->direccion;
        $this->email = $proveedor->email;
        $this->emit('modal-show','open!');
    }

    protected $listeners =[
        'deleteRow' => 'destroy',
        'resetUI' => 'resetUI'
    ];

    public function Store()
    {

        $rules =[
            'nombre' => 'required|min:3|unique:proveedores',
            'ruc' => 'required|unique:proveedores',
            'email' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',

        ];

        $messages =[
            'nombre.required' => 'Ingresa el nombre del proveedor',
            'nombre.min' => 'El nombre del proveedor debe tener al menos 3 caracteres',
            'nombre.unique' => 'El nombre del proveedor ya eta en uso',
            'ruc.required' => 'Ingresa ruc o cédula del proveedor',
            'ruc.unique' => 'El Ruc o Cedula ya existe en el sistema',
            'email.required' => 'Email del proveedor es requerido',
            'direccion.required' => 'Direccion del proveedor es requerido',
            'telefono.required' => 'Teléfono del proveedor es requerido'
        ];
        $this->validate($rules, $messages);
        $proveedor = Proveedor::create([
            'nombre' => $this->nombre,
            'ruc' => $this->ruc,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email
        ]);

        $this->resetUI();
        $this->emit('proveedor-added','Proveedor Registrado');
    }

    public function Update()
    {

        $rules =[

            'nombre' => "required|min:3|unique:proveedores,nombre,{$this->selected_id}",
            'ruc' => "required|unique:proveedores,ruc,{$this->selected_id}",
            'email' => "required|unique:proveedores,email,{$this->selected_id}",
            'direccion' => 'required',
            'telefono' => 'required'
        ];

        $messages =[
            'nombre.required' => 'Ingresa el nombre del proveedor',
            'nombre.min' => 'El nombre del proveedor debe tener al menos 3 caracteres',
            'nombre.unique' => 'El nombre del proveedor ya eta en uso',
            'ruc.required' => 'Ingresa ruc o cédula del proveedor',
            'ruc.unique' => 'El Ruc o Cedula ya existe en el sistema',
            'email.required' => 'Email del proveedor es requerido',
            'direccion.required' => 'Direccion del proveedor es requerido',
            'telefono.required' => 'Teléfono del proveedor es requerido'

        ];

        $this->validate($rules, $messages);

        $proveedor = Proveedor::find($this->selected_id);
        //dd($cliente);
        $proveedor->update([
            'nombre' => $this->nombre,
            'ruc' => $this->ruc,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'email' => $this->email
        ]);
        $this->resetUI();
        $this->emit('proveedor-updated','Proveedor Actualizado');

    }

    public function destroy(Proveedor $proveedor)
    {
       $proveedor->delete();
       $this->resetUI();
    	$this->emit('proveedor-deleted', 'Proveedor  Eliminado');
    }

}
