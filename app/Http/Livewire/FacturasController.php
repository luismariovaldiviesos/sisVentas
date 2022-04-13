<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\DetalleFactura;
use App\Models\Empresa;
use App\Models\Factura;
use App\Models\Producto;
use Carbon\Carbon;
use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;

class FacturasController extends Component
{

    // para buscar cliente
    public $buscarCliente, $razonsocial, $tipoidentificacion, $valoridentificacion, $email,
             $telefono, $clientes, $clienteSelected, $cliente_id;

    // para cabecera factura
    //codDoc claveAcceso  secuencial
    // fechaEmision  - > created_at
    public $fechafactura, $secuencial, $claveAcceso, $codDoc, $serie, $tipoEmision ;

    // para el carrito
    public $total, $itemsQuantity, $efectivo, $change;




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
       // dd($clientes);
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


        $producto = Producto::where('barcode', $barcode)->first();
        //dd($producto);
        if($producto == null || empty($empty))
        {
            $this->emit('scan-notfound', 'El producto no está  registrado');
        }
        else
        {
            if ($this->InCart($producto->id)) {  // metodo Incart valida que el producto esta o no en el carrito
                $this->increaseQty($producto->id);
                return ;
            }
            if($producto->stock < 1)
            {
                $this->emit('no-stock', 'Stock insuficiente');
                return ;
            }
            Cart::add($producto->id, $producto->nombre, $producto->precio, $cant);
            $this->total = Cart::getTotal();
            $this->emit('scan-ok', 'Porducto agregado');
        }

    }

    // metodo Incart valida que el producto esta o no en el carrito
    public function InCart($productoId)
    {
        $exist = Cart::get($productoId);
        if($exist)
                return true;
        else
                return false;
    }


    // actualziar la cantidad del producnto en el carrito
    public function increaseQty($productoId, $cant =1)
    {
        $title = '';
        $producto = Producto::find($productoId);
        $exist=  Cart::get($productoId);
        if($exist)
            $title = 'Cantidad actualizada';
        else
            $title = 'Producto agregado';

        if($exist)
        {
            if($producto->stock < ($cant + $exist->quantity)) // si la existencia de nuestro pro es menos a la suma de la cantidad mas lo que viee n en el carrito
            {
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
        }

        Cart::add($producto->id, $producto->nombre, $producto->precio, $cant);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', $title);

    }


    public function updateQty($producto, $cant = 1)
    {
        $title = '';
        $producto = Producto::find($producto);
        $exist=  Cart::get($producto);
        if($exist)
            $title = 'Cantidad actualizada';
         else
            $title = 'Producto agregado';

        if ($exist) {
            if($producto->stock < $cant)
            {
                $this->emit('no-stock', 'Stock insuficiente');
                return;
            }
        }

        $this->removeItem($producto);
        if($cant > 0)
        {
            Cart::add($producto->id, $producto->nombre, $producto->precio, $cant);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', $title);
        }

    }


    public function removeItem($productoId)
    {
        Cart::remove($productoId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
         $this->emit('scan-ok', 'Producto eliminado');
    }


    public function decreaseQty($productoId)
    {
        $item  = Cart::get($productoId);
        Cart::remove($productoId);
        $newQty = ($item->quantity) - 1;
        if($newQty > 0)
            Cart::add($item->id, $item->nombre, $item->precio, $newQty);

            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
             $this->emit('scan-ok', 'Cantidad Actualizada');
    }


    public function clearCart()
    {
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
         $this->emit('scan-ok', 'Carrito vacio');
    }






    public  function  mostrarCliente($cliente)
    {
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
