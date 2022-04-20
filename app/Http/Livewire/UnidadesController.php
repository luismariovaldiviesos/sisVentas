<?php

namespace App\Http\Livewire;

use App\Models\Unidades;
use Livewire\Component;
use Livewire\WithPagination;

class UnidadesController extends Component
{

    use WithPagination;
    public $nombre,$search,$selected_id,$pageTitle,$componentName;
	private $pagination = 5;

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Unidades de Medida';

	}

    public function render()
	{
		if(strlen($this->search) > 0)
			$data = Unidades::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Unidades::orderBy('id','desc')->paginate($this->pagination);



		return view('livewire.unidades.component', ['data' => $data])
		->extends('layouts.theme.app')
		->section('content');
	}


    public function resetUI()
	{
		$this->nombre ='';
		$this->search ='';
		$this->selected_id =0;
	}

    public function Edit($id)
	{
		$record = Unidades::find($id, ['id','nombre']);
        $this->selected_id = $record->id;
		$this->nombre = $record->nombre;
		$this->emit('show-modal', 'show modal!');
	}


    public function Store()
	{
		$rules = [
			'nombre' => 'required'

		];

		$messages = [
			'nombre.required' => 'Nombre del impuesto es requerido'
		];

		$this->validate($rules, $messages);

		$unidad = Unidades::create([
			'nombre' => $this->nombre,

		]);
		$this->resetUI();
		$this->emit('unidad-added','Unidad de medida registrada');

	}

    public function Update()
	{
		$rules =[
			'nombre' => 'required'
		];

		$messages =[
			'nombre.required' => 'Nombre del impuesto es requerido'

		];

		$this->validate($rules, $messages);


		$unidad = Unidades::find($this->selected_id);
		$unidad->update([
			'nombre' => $this->nombre
		]);
		$this->resetUI();
		$this->emit('unidad-updated', 'Unidad de medida actualizada');
	}

    protected  $listeners = [
		'deleteRow' => 'Destroy'
	];

    public function Destroy (Unidades $unidad){

        $unidad->delete();
        $this->resetUI();
        $this->emit('unidad-deleted', 'Unidad de medida Eliminada');
    }

}
