<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\DetalleFactura;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\Producto;
use App\Traits\CartTrait;
use Carbon\Carbon;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;

class FacturasController extends Component
{

    use CartTrait;
    // para buscar cliente
    public $buscarCliente, $razonsocial, $tipoidentificacion, $valoridentificacion, $email,
             $telefono, $clientes, $clienteSelected, $cliente_id;

    // para cabecera factura
    //codDoc claveAcceso  secuencial
    // fechaEmision  - > created_at
    public $fechafactura, $secuencial, $claveAcceso, $codDoc, $serie, $tipoEmision ;

    // para el carrito
    public $total, $itemsQuantity, $efectivo, $change;


    // para el detalle de factura
    public $porcentajeDescto, $totalDescuento;




    public function  mount()
    {
        $this->efectivo = 0;
        $this->change =0;
        $this->total = Cart::getTotal();  // metodo que tiene el carrito
        $this->itemsQuantity = Cart::getTotalQuantity(); // metodo que tiene el carrito



        $fact  = new Factura();
        $this->fechafactura =  Carbon::now()->format('d-m-Y');
        $this->claveAcceso = $fact->claveAcceso();
        $this->secuencial = $fact->secuencial();
       //dd($this->claveAcceso);

       $this->porcentajeDescto =0;
       $this->totalDescuento =0;

    }

    public function calculaPorcentaje()
    {
        $subtotal  =  $this->total * $this->porcentajeDescto ;
        $this->totalDescuento =  $subtotal;
    }

    public  function actualizaPorcentaje ($porcentaje)
    {
        $this->porcentajeDescto = $this->porcentajeDescto + $porcentaje;
        dd($this->porcentajeDescto);
    }


    public function render()
    {

        $clientes = null;
        $empresa =  Empresa::all();

        //buscar clientes
        if(strlen($this->buscarCliente) > 0)
        {
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')
                                ->orWhere('razonsocial','like', '%' . $this->buscarCliente . '%')->get();

        }
        else{
            $clientes = Cliente::where('valoridentificacion','like', '%' . $this->buscarCliente . '%')
                                ->orWhere('razonsocial','like', '%' . $this->buscarCliente . '%')->get();
        }

        $this->clientes = $clientes;
       //dd($clientes);
        return view('livewire.facturas.component', [

            'empresa' =>  $empresa,
            'cart' => Cart::getContent()->sortBy('name'),

        ])->extends('layouts.theme.app')
		->section('content');

    }


    protected $listeners = [

        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'clearCart' => 'clearCart',
        'saveSale' => 'saveSale'
    ];

    // metodo cuando se escanea el codigo
    public function ScanCode($barcode , $cant =1){

        $this->ScanearCode($barcode, $cant);
    }


    // actualziar la cantidad del producnto en el carrito
    public function increaseQty(Producto $product, $cant =1)
    {
        $this->IncreaseQuantity($product, $cant);

    }


    public function updateQty(Producto $product, $cant = 1)
    {
        if($cant <=0)
			$this->removeItem($product->id);
		else
			$this->UpdateQuantity($product, $cant);

    }


    public function decreaseQty($productId)
    {
        //dd($productId);
        $this->decreaseQuantity($productId);
    }


    public function clearCart()
    {
        $this->trashCart();
    }







    public  function  mostrarCliente($cliente)
    {
        //dd($cliente);
        $this->clientes = '';
        $this->buscarCliente = '';
        $clienteJson = json_decode($cliente);
        $this->cliente_id = $clienteJson->id;
        $this->razonsocial =  $clienteJson->razonsocial;
        $this->tipoidentificacion =  $clienteJson->tipoidentificacion;
        $this->valoridentificacion =  $clienteJson->valoridentificacion;
        $this->email =  $clienteJson->email;
        $this->telefono =  $clienteJson->telefono;
    }

    public function limpiarCliente()
    {
        $this->razonsocial =  "";
        $this->tipoidentificacion =  "";
        $this->valoridentificacion =  "";
        $this->email = "";
        $this->telefono =  "";
    }



    public function saveSale()
    {
        if($this->total <=0)
		{
			$this->emit('sale-error','AGEGA PRODUCTOS A LA VENTA');
			return;
		}
		if($this->efectivo <=0)
		{
			$this->emit('sale-error','INGRESA EL EFECTIVO');
			return;
		}
		if($this->total > $this->efectivo)
		{
			$this->emit('sale-error','EL EFECTIVO DEBE SER MAYOR O IGUAL AL TOTAL');
			return;
		}
        if($this->cliente_id == null){

            $this->emit('sale-error','iNGRESA DATOS DEL CLIENTE');
			return;
        }

        DB::beginTransaction();

        try {
            $factura  =  Factura::create([
                'cliente_id' => $this->cliente_id,
                'user_id' => Auth()->user()->id,
                'codDoc' => '01',
                'claveAcceso' =>   $this->claveAcceso,
                'secuencial' =>   $this->secuencial,
                'estado' => 'PAGADA'

            ]);

            //dd($factura);
            if($factura){
                $items = Cart::getContent();
                foreach ($items as  $item) {
					DetalleFactura::create([
						'factura_id' => $factura->id,
						'producto_id' => $item->id,
						'cantidad' => $item->cantidad,
						'precioUnitario' => $item->precioUnitario,
					]);

					//update stock
					$producto = Producto::find($item->id);
					$producto->stock = $producto->stock - $item->cantidad;
					$producto->save();
				}

            }

            DB::commit();
            Cart::clear();
            $this->efectivo =0;
            $this->change =0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok','Venta registrada con éxito');
            $this->emit('print-ticket', $factura->id);

        } catch (Exception $e) {
			DB::rollback();
			$this->emit('sale-error', $e->getMessage());
		}

    }


    public function printTicket($factura)
	{
		 return redirect("print:://$factura->id");

	}


}
