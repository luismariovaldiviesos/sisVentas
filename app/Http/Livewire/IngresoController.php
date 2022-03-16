<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class IngresoController extends Component
{


    use WithPagination;
	use WithFileUploads;

    public $proveedor_id,$user_id,$tipoidentificador,$valoridentificador,$ingreso_id,$producto_id,$cantidad,$total, $search,$selected_id,$pageTitle,$componentName;
	private $pagination = 5;

    public function resetUI()
	{
		$this->proveedor_id ='';
		$this->user_id ='';
		$this->tipoidentificador ='';
		$this->valoridentificador ='';
		$this->ingreso_id ='';
		$this->producto_id ='';
		$this->search ='';
        $this->total ="";
		$this->cantidad='Elegir';
	    $this->selected_id = 0;



	}


    public function paginationView()
	{
		return 'vendor.livewire.bootstrap';
	}


	public function mount()
	{
		$this->pageTitle = 'Listado';
		$this->componentName = 'Ingreso de Mercaderia';
		$this->categoryid = 'Elegir';

	}

    public function render()
    {
        if(strlen($this->search) > 0)
			$data = Ingreso::where('valoridentificador', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Ingreso::orderBy('id','desc')->paginate($this->pagination);
        return view('livewire.ingresos.component',

            [
                'data' =>$data,
                'proveedores' => Proveedor::all(),
                'productos' => Producto::all()

            ]

        )->extends('layouts.theme.app')
		->section('content');
    }

    protected $listeners = [

        'detalles' => 'Detalles'
    ];

    public function Detalles($id_producto,$cantidades,$total)
    {

        dd( 'vamos a guradar en ingreso:: proveedor_id', $this->proveedor_id,
            'productos: ', $id_producto, 'cantidades', $cantidades, 'total ingreso ', $total);
    }









}
