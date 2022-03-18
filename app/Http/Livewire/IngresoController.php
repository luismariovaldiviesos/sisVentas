<?php

namespace App\Http\Livewire;

use App\Models\Ingreso;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;
class IngresoController extends Component
{


    use WithPagination;
	use WithFileUploads;

    // variables ingrso
    public $proveedor_id,$user_id,$tipoidentificador,
    $valoridentificador, $totalingreso,

    // variables detalle ingreso
    $ingreso_id,$producto_id,
    $cantidad,$preciocompra,

    // variables componente
    $search,$selected_id,
    $pageTitle,$componentName;
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

        'guardaIngreso' => 'guardaIngreso'
    ];

    public function guardaIngreso($arregloproductos,$arreglocantidades,$arreglosprecioscompra,$totalingreso)
    {


        //dd('empezamos transaccion');

        // DB::beginTransaction();
        // try{

        //     $ingreso =  Ingreso::create([
        //         'proveedor_id' => $this->proveedor_id,
        //         'user_id' =>  Auth()->user()->id,
        //         'tipoidentificador' => $this->tipoidentificador,
        //         'valoridentificador' => $this->valoridentificador,
        //         'totalingreso' => $totalingreso
        //     ]);

        //     if($ingreso){

        //     }

        // }
        // catch (Exception $e) {
		// 	DB::rollback();
		// 	$this->emit('sale-error', $e->getMessage());
		// }


        dd(
            'datos de ingrso --> proveedor_id', $this->proveedor_id,
            'datos de ingrso --> user id', $this->user_id,
            'datos de ingrso --> tipo idientificado', $this->tipoidentificador,
            'datos de ingrso --> valor indentificador', $this->valoridentificador,
            'datos de ingrso --> total ingreso ', $totalingreso,
            'array de  ides productos --> ', collect($arregloproductos)->all(),
            'array de   cantidades --> ', collect($arreglocantidades)->all(),
            'array de   precios de compra --> ', collect($arreglosprecioscompra)->all(),
        );
    }









}
