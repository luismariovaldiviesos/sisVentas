<?php

namespace App\Http\Livewire;

use App\Models\Descuento;
use Livewire\Component;
use Livewire\WithPagination;


class DescuentosController extends Component
{

    use WithPagination;
    public $porcentaje,$search,$selected_id,$pageTitle,$componentName;
	private $pagination = 10;

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Descuentos';

	}

    public function render()
	{
		if(strlen($this->search) > 0)
			$data = Descuento::where('porcentaje', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Descuento::orderBy('id','asc')->paginate($this->pagination);



		return view('livewire.descuentos.component', ['data' => $data])
		->extends('layouts.theme.app')
		->section('content');
	}

    public function resetUI()
	{
		$this->porcentaje ='';
		$this->search ='';
		$this->selected_id =0;
	}

    public function Edit($id)
	{

		$record = Descuento::find($id);
        //dd($record);
        $this->selected_id = $record->id;
		$this->porcentaje = $record->porcentaje;
        $this->emit('show-modal', 'show modal!');
	}

    public function Store()
	{
		$rules = [

            'porcentaje' => 'required|numeric',


		];

		$messages = [

            'porcentaje.required' => 'Porcentaje del descuento es requerido',
			'porcentaje.numeric' => 'Porcentaje del descuento debe ser número',

		];

		$this->validate($rules, $messages);

		$descuento = Descuento::create([

            'porcentaje' => $this->porcentaje
		]);
		$this->resetUI();
		$this->emit('descuento-added','descuento  Registrado');

	}

    public function Update()
	{
		$rules =[

            'porcentaje' => 'required|numeric'
		];

		$messages =[

            'porcentaje.required' => 'Porcentaje del descuento es requerido',
			'porcentaje.numeric' => 'Porcentaje del descuento debe ser número',
		];

		$this->validate($rules, $messages);


		$descuento = Descuento::find($this->selected_id);
		$descuento->update([

            'porcentaje' => $this->porcentaje

		]);



		$this->resetUI();
		$this->emit('descuento-updated', 'descuento  Actualizado');
	}

    protected  $listeners = [
		'deleteRow' => 'Destroy'
	];

    public function Destroy (Descuento $descuento){

        $descuento->delete();
        $this->resetUI();
        $this->emit('descuento-deleted', 'descuento Eliminado');
    }

}
