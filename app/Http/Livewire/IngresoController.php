<?php

namespace App\Http\Livewire;

use App\Models\DetalleIngreso;
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

    // poara detalles
    public $detalles =[];

    public function resetUI()
	{
		$this->proveedor_id ='';
		$this->user_id ='';
		$this->tipoidentificador ='Elegir';
		$this->valoridentificador ='';
		$this->ingreso_id ='';
		$this->producto_id ='';
		$this->search ='';
        $this->total ="";
		$this->cantidad='';
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

        'guardaIngreso' => 'guardaIngreso',
        'deleteRow' => 'eliminarIngreso'
    ];

    public function guardaIngreso($arregloproductos,$arreglocantidades,$arreglosprecioscompra,$totalingreso)
    {
        $rules  =[
			'proveedor_id' => 'required',
			'tipoidentificador' => 'required|not_in:Elegir',
			'valoridentificador' => 'required'


		];

		$messages = [
			'proveedor_id.required' => 'Nombre del provvedor requerido',
            'tipoidentificador.required' => 'Tipo identificador requerido',
			'tipoidentificador.not_in' => 'Elige un identificadora diferente de Elegir',
            'valoridentificador.required' => 'valor identificador requerido'

		];

		$this->validate($rules, $messages);

        DB::beginTransaction();
        try{

            $ingreso =  Ingreso::create([
                'proveedor_id' => $this->proveedor_id,
                'user_id' =>  Auth()->user()->id,
                'tipoidentificador' => $this->tipoidentificador,
                'valoridentificador' => $this->valoridentificador,
                'totalingreso' => $totalingreso
            ]);

            if($ingreso){

                $cont  =0;
                while($cont < count($arregloproductos))
                {
                    DetalleIngreso::create([
                    'ingreso_id' => $ingreso->id,
                    'producto_id' => $arregloproductos[$cont],
                    'cantidad' => $arreglocantidades[$cont],
                    'preciocompra' => $arreglosprecioscompra[$cont]
                    ]);

                    //stock
                    $producto  = Producto::find($arregloproductos[$cont]);
                    $producto->stock = $producto->stock + intval($arreglocantidades[$cont]);
                    $producto->save();
                    //aumentamos contador
                    $cont =  $cont +1;
                }
            }
            DB::commit();
            $this->resetUI();
            $arregloproductos = [];
            $arreglocantidades = [];
            $arreglosprecioscompra = [];
            $totalingreso = 0;
            $this->emit('ingreso-ok','Ingreso de mercaderia registrado con éxito');

        }
        catch (Exception $e) {
			DB::rollback();
			$this->emit('ingreso-error', $e->getMessage());
		}
    }


   public function eliminarIngreso(Ingreso $ingreso){
        dd('eliminar ingreso ', $ingreso);
    }

    public function detalleIngreso(Ingreso $ingreso){
        $this->detalles = $ingreso->detalles;
        //dd($this->detalles);
        $this->emit('show-modal2','details loaded');
    }



}
