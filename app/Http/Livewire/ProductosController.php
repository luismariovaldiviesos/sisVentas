<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Impuesto;
use App\Models\Producto;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ProductosController extends Component
{

    use WithPagination;
	use WithFileUploads;

    public $nombre,$barcode,$costo,$precio,$stock,$alertas,$categoria_id, $search,$selected_id,$pageTitle,$componentName;
	private $pagination = 5;

    public $selectedImpuestos =[];

    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Productos';
		$this->categoryid = 'Elegir';

	}

    public function render()
	{
		if(strlen($this->search) > 0)
			$products = Producto::join('categorias as c','c.id','productos.categoria_id')
		->select('productos.*','c.nombre as categoria')
		->where('productos.nombre', 'like', '%' . $this->search . '%')
		->orWhere('productos.barcode', 'like', '%' . $this->search . '%')
		->orWhere('c.nombre', 'like', '%' . $this->search . '%')
		->orderBy('productos.nombre', 'asc')
		->paginate($this->pagination);
		else
		 $products = Producto::join('categorias as c','c.id','productos.categoria_id')
		->select('productos.*','c.nombre as categoria')
		->orderBy('productos.nombre', 'asc')
		->paginate($this->pagination);

		return view('livewire.productos.component', [
			'data' => $products,
			'categorias' => Categoria::orderBy('nombre', 'asc')->get(),
            'impuestos' => Impuesto::orderBy('id','asc')->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

    public function Store()
	{
        //dd($this->selectedImpuestos);
		$rules  =[
			'nombre' => 'required|unique:productos|min:3',
			'costo' => 'required',
			'precio' => 'required',
			'stock' => 'required',
			'alertas' => 'required',
			'categoria_id' => 'required|not_in:Elegir'

		];

		$messages = [
			'nombre.required' => 'Nombre del producto requerido',
			'nombre.unique' => 'Ya existe el nombre del producto',
			'nombre.min' => 'El nombre del producto debe tener al menos 3 caracteres',
			'costo.required' => 'El costo es requerido',
			'precio.required' => 'El precio es requerido',
			'stock.required' => 'El stock es requerido',
			'alertas.required' => 'Ingresa el valor mínimo en existencias',
			'categoria_id.not_in' => 'Elige un nombre de categoría diferente de Elegir'
		];

		$this->validate($rules, $messages);

		$product = Producto::create([
			'nombre' => $this->nombre,
			'costo' => $this->costo,
			'precio' => $this->precio,
			'barcode' => $this->barcode,
			'stock' => $this->stock,
			'alertas' => $this->alertas,
			'categoria_id' => $this->categoria_id
		]);
        $product->impuestos()->sync($this->selectedImpuestos, true);
		$this->resetUI();
		$this->emit('product-added', 'Producto Registrado');


	}


    public function resetUI()
	{
		$this->nombre ='';
		$this->barcode ='';
		$this->costo ='';
		$this->precio ='';
		$this->stock ='';
		$this->alertas ='';
		$this->search ='';
		$this->categoria_id='Elegir';
	    $this->selected_id = 0;
        $this->selectedImpuestos = [];


	}

    public function Edit(Producto $product)
	{
		$this->selected_id = $product->id;
		$this->nombre = $product->nombre;
		$this->barcode = $product->barcode;
		$this->costo = $product->costo;
		$this->precio = $product->precio;
		$this->stock = $product->stock;
		$this->alertas = $product->alertas;
		$this->categoria_id = $product->categoria_id;
		$this->emit('modal-show','Show modal');
	}


    public function Update()
	{
		$rules  =[
			'nombre' => "required|min:3|unique:productos,nombre,{$this->selected_id}",
			'costo' => 'required',
			'precio' => 'required',
			'stock' => 'required',
			'alertas' => 'required',
			'categoria_id' => 'required|not_in:Elegir'
		];

		$messages = [
			'name.required' => 'Nombre del producto requerido',
			'name.unique' => 'Ya existe el nombre del producto',
			'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
			'costo.required' => 'El costo es requerido',
			'precio.required' => 'El precio es requerido',
			'stock.required' => 'El stock es requerido',
			'alertas.required' => 'Ingresa el valor mínimo en existencias',
			'categoria_id.not_in' => 'Elige un nombre de categoría diferente de Elegir'
		];

		$this->validate($rules, $messages);

		$product = Producto::find($this->selected_id);

		$product->update([
			'nombre' => $this->nombre,
			'costo' => $this->costo,
			'precio' => $this->precio,
			'barcode' => $this->barcode,
			'stock' => $this->stock,
			'alertas' => $this->alertas,
			'categoria_id' => $this->categoria_id
		]);
        $product->impuestos()->sync($this->selectedImpuestos, true);
	    $this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}

    protected $listeners =[
		'deleteRow' => 'Destroy'
	];

    public function Destroy(Producto $product)
	{
		$product->delete();
		$this->resetUI();
		$this->emit('product-deleted', 'Producto Eliminado');
	}

}
