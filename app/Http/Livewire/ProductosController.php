<?php

namespace App\Http\Livewire;

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
			$products = Producto::join('categories as c','c.id','products.category_id')
		->select('products.*','c.name as category')
		->where('products.name', 'like', '%' . $this->search . '%')
		->orWhere('products.barcode', 'like', '%' . $this->search . '%')
		->orWhere('c.name', 'like', '%' . $this->search . '%')
		->orderBy('products.name', 'asc')
		->paginate($this->pagination);
		else
		 $products = Product::join('categories as c','c.id','products.category_id')
		->select('products.*','c.name as category')
		->orderBy('products.name', 'asc')
		->paginate($this->pagination);





		return view('livewire.products.component', [
			'data' => $products,
			'categories' => Category::orderBy('name', 'asc')->get(),
            'impuestos' => Impuesto::orderBy('id','asc')->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}
}
