<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Descuento;
use App\Models\Impuesto;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Unidades;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;
use App\Traits\CartTrait;

class ProductosController extends Component
{

    use WithPagination;
	use WithFileUploads;
    use CartTrait;


    public $nombre,$barcode,$costo,$precio,$stock,$alertas,$categoria_id, $unidad_id, $search,$selected_id,$pageTitle,$componentName;
	private $pagination = 20;

    public $pvp, $impuestoProducto = 0 ;

    public $selectedImpuestos =[];

    public $impuestosProductos = []; // para sabe qué impuestos ya estan vinculados al producto

    public $selectedProveedores =[];

    public $descuento_id, $descuentoProducto;



    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


	public function mount()
	{
        $this->pageTitle = 'Listado';
		$this->componentName = 'Productos';
		$this->categoria_id = 'Elegir';
        $this->unidad_id = 'Elegir';
        $this->descuento_id = 'Elegir';
        $this->selected_id = 0;

	}

    public function render()
	{
        $product =  Producto::find(3);
        //dd($this->calculaPVP($product));

		if(strlen($this->search) > 0)
			$products = Producto::join('categorias as c','c.id','productos.categoria_id')
		->select('productos.*','c.nombre as categoria')
		->where('productos.nombre', 'like', '%' . $this->search . '%')
		->orWhere('productos.barcode', 'like', '%' . $this->search . '%')
		->orWhere('c.nombre', 'like', '%' . $this->search . '%')
		->orderBy('productos.id', 'asc')  // ultimo ingresado arriba
		->paginate($this->pagination);
		else
		 $products = Producto::join('categorias as c','c.id','productos.categoria_id')
		->select('productos.*','c.nombre as categoria')
		->orderBy('productos.id', 'asc')
		->paginate($this->pagination);

		return view('livewire.productos.component', [
			'data' => $products,
			'categorias' => Categoria::orderBy('id', 'asc')->get(),
            'impuestos' => Impuesto::orderBy('id','asc')->get(),
            'proveedores' => Proveedor::orderBy('id','asc')->get(),
            'unidades' => Unidades::orderBy('id','asc')->get(),
            'descuentos' => Descuento::orderBy('id','asc')->get()
		])
		->extends('layouts.theme.app')
		->section('content');
	}

    public function Store()
	{
        //dd($this->descuento_id);
        $cont = count($this->selectedImpuestos);
        if($cont <= 0)
        {
            $this->emit('product-error','AGREGA AL MENOS UN IMPUESTO AL PRODUCTO');
			return;
        }
        if($this->descuento_id ==  'Elegir')
        {
            $this->emit('product-error','AGREGA AL MENOS UN DESCUENTO AL PRODUCTO');
			return;
        }

		$rules  =[
			'nombre' => 'required|unique:productos|min:3',
            'barcode' => "required|unique:productos,barcode",
			'costo' => 'required',
			'precio' => 'required',
			'stock' => 'required',
			'alertas' => 'required',
			'categoria_id' => 'required|not_in:Elegir',
            'unidad_id' => 'required|not_in:Elegir',
            'descuento_id' => 'required|not_in:Elegir'

		];

		$messages = [
			'nombre.required' => 'Nombre del producto requerido',
			'nombre.unique' => 'Ya existe el nombre del producto',
			'nombre.min' => 'El nombre del producto debe tener al menos 3 caracteres',
            'barcode.required' => 'código del producto requerido',
			'barcode.unique' => 'Ya existe el código del producto',
			'costo.required' => 'El costo es requerido',
			'precio.required' => 'El precio es requerido',
			'stock.required' => 'El stock es requerido',
			'alertas.required' => 'Ingresa el valor mínimo en existencias',
			'categoria_id.not_in' => 'Elige un nombre de categoría diferente de Elegir',
            'unidad_id.not_in' => 'Elige un nombre de unidad diferente de Elegir',
            'descuento_id.not_in' => 'Elige un descuento diferente de Elegir'
		];

		$this->validate($rules, $messages);

		$product = Producto::create([
			'nombre' => $this->nombre,
			'costo' => $this->costo,
			'precio' => $this->precio,
			'barcode' => $this->barcode,
			'stock' => $this->stock,
			'alertas' => $this->alertas,
			'categoria_id' => $this->categoria_id,
            'unidad_id' => $this->unidad_id,
            'descuento_id' => $this->descuento_id
		]);
        $product->impuestos()->sync($this->selectedImpuestos, true);
        $product->proveedores()->sync($this->selectedProveedores, true);
        $this->pvp =  $this->calculaPVP($product);
        $affected =  DB::table('productos')->where('id', $product->id)->update(['pvp' => $this->pvp]);

		$this->resetUI();
		$this->emit('product-added', 'Producto Registrado');


	}



    public function calculaPVP( Producto $producto)
    {
        //$producto =  Producto::find($id);
        $porcentaje = 0;
        //$pvp  =  0;
        foreach($producto->impuestos as $imp)
        {
             $porcentaje =  $porcentaje + $imp->porcentaje;
        }
		// descuento porcentaje
		$desPorcentaje =  $producto->descuento->porcentaje;

        // descuento producto
        $descuentoProducto  = ($producto->precio * $desPorcentaje) / 100;

        //subtotal  precio
        $subt  =  $producto->precio - $descuentoProducto;

        // impuestos sobr el precio ya aplicado el descto si lo hay
        $preciotem = ($subt * $porcentaje) / 100;

        $pvp  = $subt + $preciotem;


        return $pvp;

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
        $this->unidad_id='Elegir';
	    $this->selected_id = 0;
        $this->selectedImpuestos = [];
        $this->selectedProveedores = [];
        $this->descuentoProducto ="";


	}

    public function Edit(Producto $product)
	{

        //dd($this->descuentoProducto = $product->descuento->porcentaje);
		$this->selected_id = $product->id;
		$this->nombre = $product->nombre;
		$this->barcode = $product->barcode;
		$this->costo = $product->costo;
		$this->precio = $product->precio;
		$this->stock = $product->stock;
		$this->alertas = $product->alertas;
		$this->categoria_id = $product->categoria_id;
        $this->unidad_id = $product->unidad_id;
        $this->impuestosProductos =  $product->impuestos;
        $this->descuentoProducto = $product->descuento;
        $this->descuentoProducto = $product->descuento->porcentaje;
        $this->emit('modal-show','Show modal');
	}

    // public function DescuentoProd($product)
    // {
    //     $descuentoProducto = $product->descuentos;
    //     $porcentajeDescuento = 0;
    //     if(count($descuentoProducto)> 0)
    //     {
    //        foreach($descuentoProducto as $d)
    //        {
    //             $temp =  $d->porcentaje;
    //             $porcentajeDescuento = $porcentajeDescuento + $temp;
    //        }
    //     }
    //     else
    //     {
    //         $porcentajeDescuento = $porcentajeDescuento;
    //     }
    //     return $porcentajeDescuento;
    // }


    public function Update()
	{
		$rules  =[
			'nombre' => "required|min:3|unique:productos,nombre,{$this->selected_id}",
            'barcode' => "required|unique:productos,barcode,{$this->selected_id}",
			'costo' => 'required',
			'precio' => 'required',
			'stock' => 'required',
			'alertas' => 'required',
			'categoria_id' => 'required|not_in:Elegir',
            'unidad_id' => 'required|not_in:Elegir',
            'descuento_id' => 'required|not_in:Elegir'
		];

		$messages = [
			'name.required' => 'Nombre del producto requerido',
			'name.unique' => 'Ya existe el nombre del producto',
            'barcode.required' => 'codigo  del producto requerido',
			'barcode.unique' => 'Ya existe el codigo del producto',
			'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
			'costo.required' => 'El costo es requerido',
			'precio.required' => 'El precio es requerido',
			'stock.required' => 'El stock es requerido',
			'alertas.required' => 'Ingresa el valor mínimo en existencias',
			'categoria_id.not_in' => 'Elige un nombre de categoría diferente de Elegir',
            'unidad_id.not_in' => 'Elige un nombre de unidad diferente de Elegir',
            'unidad_id.not_in' => 'Elige un descuento  diferente de Elegir'
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
			'categoria_id' => $this->categoria_id,
            'unidad_id' => $this->unidad_id,
            'descuento_id' => $this->descuento_id
		]);
        $product->impuestos()->sync($this->selectedImpuestos, true);
        $product->proveedores()->sync($this->selectedProveedores, true);
        $this->pvp =  $this->calculaPVP($product);
        $affected =  DB::table('productos')->where('id', $product->id)->update(['pvp' => $this->pvp]);

        $this->resetUI();
		$this->emit('product-updated', 'Producto Actualizado');
	}

    protected $listeners =[
		'deleteRow' => 'Destroy',

	];


    public function Destroy(Producto $product)
	{
		$product->delete();
		$this->resetUI();
		$this->emit('product-deleted', 'Producto Eliminado');
	}


    public  function ScanCode($code)
    {
        $this->ScanearCode($code);
        $this->emit('product-added','SE AGREGÓ EL PRODUCTO A LA VENTA');
    }

}
