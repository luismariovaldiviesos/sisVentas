<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Categoria;

class CategoriaController extends Component
{
    use WithFileUploads;
	use WithPagination;

    public $nombre, $search, $selected_id, $pageTitle, $componentName;
	private $pagination = 5;

    public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Categorías';
	}

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}

    public function render()
	{
		if(strlen($this->search) > 0)
			$data = Categoria::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Categoria::orderBy('id','desc')->paginate($this->pagination);



		return view('livewire.categorias.component', ['categorias' => $data])
		->extends('layouts.theme.app')
		->section('content');
	}


    public function Edit($id)
	{
		$record = Categoria::find($id, ['id','nombre']);
		$this->nombre = $record->nombre;
		$this->selected_id = $record->id;

		$this->emit('show-modal', 'show modal!');
	}



	public function Store()
	{
		$rules = [
			'nombre' => 'required|unique:categorias|min:3'
		];

		$messages = [
			'nombre.required' => 'Nombre de la categoría es requerido',
			'nombre.unique' => 'Ya existe el nombre de la categoría',
			'nombre.min' => 'El nombre de la categoría debe tener al menos 3 caracteres'
		];

		$this->validate($rules, $messages);

		$category = Categoria::create([
			'nombre' => $this->nombre
		]);



		$this->resetUI();
		$this->emit('category-added','Categoría Registrada');

	}


	public function Update()
	{
		$rules =[
			'nombre' => "required|min:3|unique:categorias,nombre,{$this->selected_id}"
		];

		$messages =[
			'nombre.required' => 'Nombre de categoría requerido',
			'nombre.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
			'nombre.unique' => 'El nombre de la categoría ya existe'
		];

		$this->validate($rules, $messages);


		$category = Categoria::find($this->selected_id);
		$category->update([
			'nombre' => $this->nombre
		]);



		$this->resetUI();
		$this->emit('category-updated', 'Categoría Actualizada');



	}


	public function resetUI()
	{
		$this->nombre ='';
		$this->search ='';
		$this->selected_id =0;
	}


    protected $listeners =[
		'deleteRow' => 'Destroy'
	];


	public function Destroy(Categoria $category)
	{
    	$category->delete();
    	$this->resetUI();
		$this->emit('category-deleted', 'Categoría Eliminada');

	}
}
