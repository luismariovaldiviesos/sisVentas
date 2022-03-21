<?php

namespace App\Http\Livewire;

use App\Models\DetalleEgreso;
use App\Models\Egreso;
use App\Models\Producto;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use DB;

class EgresosController extends Component
{
    use WithPagination;

    // variables ingrso
    public $proveedor_id,$user_id,$tipoidentificador,
    $valoridentificador, $totalingreso,

    // variables detalle EGRESO
    $ingreso_id,$producto_id,
    $cantidad,$preciocompra, $observaciones,

    // variables componente
    $search,$selected_id,
    $pageTitle,$componentName;
	private $pagination = 5;

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
		$this->componentName = 'Egresos de Mercaderia';

	}

    public function render()
    {
        if(strlen($this->search) > 0)
			$data = Egreso::where('valoridentificador', 'like', '%' . $this->search . '%')->paginate($this->pagination);
		else
			$data = Egreso::orderBy('id','desc')->paginate($this->pagination);
        return view('livewire.egresos.component',

            [
                'data' =>$data,
                'proveedores' => Proveedor::all(),
                'productos' => Producto::all()

            ]

        )->extends('layouts.theme.app')
		->section('content');

    }

    protected $listeners = [

        'guardaEgreso' => 'guardaEgreso',
        'deleteRow' => 'eliminarEgreso'
    ];



    public function guardaEgreso($arregloproductos,$arreglocantidades,$arreglosprecioscompra,$totalegreso)
    {
        $rules  =[
			'proveedor_id' => 'required',
			'tipoidentificador' => 'required|not_in:Elegir',
			'valoridentificador' => 'required',
            'observaciones' => 'required'


		];

		$messages = [
			'proveedor_id.required' => 'Nombre del provvedor requerido',
            'tipoidentificador.required' => 'Tipo identificador requerido',
			'tipoidentificador.not_in' => 'Elige un identificadora diferente de Elegir',
            'valoridentificador.required' => 'valor identificador requerido',
            'observaciones.required' => 'ingrese observaciones del egreso'

		];

		$this->validate($rules, $messages);

        DB::beginTransaction();
        try{

            $egreso =  Egreso::create([
                'proveedor_id' => $this->proveedor_id,
                'user_id' =>  Auth()->user()->id,
                'tipoidentificador' => $this->tipoidentificador,
                'valoridentificador' => $this->valoridentificador,
                'totalegreso' => $totalegreso,
                'observaciones' => $this->observaciones
            ]);

            if($egreso){

                $cont  =0;
                while($cont < count($arregloproductos))
                {
                    DetalleEgreso::create([
                    'egreso_id' => $egreso->id,
                    'producto_id' => $arregloproductos[$cont],
                    'cantidad' => $arreglocantidades[$cont],
                    'preciocompra' => $arreglosprecioscompra[$cont]
                    ]);

                    //stock
                    $producto  = Producto::find($arregloproductos[$cont]);
                    $producto->stock = $producto->stock - intval($arreglocantidades[$cont]);
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
            $totalegreso = 0;
            $this->emit('egreso-ok','Egreso de mercaderia registrado con éxito');

        }
        catch (Exception $e) {
			DB::rollback();
			$this->emit('egreso-error', $e->getMessage());
		}
    }

    public function eliminarEgreso(Egreso $egreso){
        dd('eliminar Egreso ', $egreso);
    }

    public function detalleEgreso(Egreso $egreso){
        dd('ver detalle', $egreso);
    }

}
