<?php
namespace App\Traits;

use Darryldecode\Cart\Facades\CartFacade as Cart;

use App\Models\Producto;

trait CartTrait
 {

        public function ScanearCode($barcode, $cant = 1)
        {

            $product = Producto::where('barcode', $barcode)->first();


            if($product == null || empty($product))
            {
                    $this->emit('scan-notfound','El producto no está registrado');
            }
            elseif( count($product->impuestos) == 0)
            {
                $this->emit('tax-notfound','El producto no tiene impuestos');
            }
            else {

                    if($this->InCart($product->id))
                    {
                            $this->IncreaseQuantity($product);
                            return;
                    }

                    if($product->stock <1)
                    {
                            $this->emit('no-stock','Stock insuficiente *');
                            return;
                    }
                    $model =

                    Cart::add($product->id, $product->nombre, $product->pvp, $cant, $product->descuento->porcentaje, $product->impuestos, $product);
                    //Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
                    $cart = Cart::getContent();

                    //dd($cart);
                    $this->total = Cart::getTotal();
                    $this->itemsQuantity = Cart::getTotalQuantity();
                    $this->emit('scan-ok','Producto agregado*');


            }

        }

        // metodo Incart valida que el producto esta o no en el carrito
        public function InCart($productId)
        {
                $exist = Cart::get($productId);
                if($exist)
                        return true;
                else
                        return false;
        }


        public function IncreaseQuantity($product, $cant = 1)
        {
                $title ='';

                $exist = Cart::get($product->id);
                if($exist)
                        $title = 'Cantidad actualizada*';
                else
                        $title ='Producto agregado*';

                if($exist)
                {
                        if($product->stock < ($cant + $exist->quantity))
                        {
                                $this->emit('no-stock','Stock insuficiente *');
                                return;
                        }
                }


        //        Cart::add($product->id, $product->name, $product->price, $cant, $product->image);
                Cart::add($product->id, $product->nombre, $product->pvp, $cant, $product->descuento->porcentaje, $product->impuestos);
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('scan-ok', $title);

        }


        public function updateQuantity($product, $cant = 1)
        {
                $title='';
                //$product = Product::find($productId);
                $exist = Cart::get($product->id);
                if($exist)
                        $title = 'Cantidad actualizada*';
                else
                        $title ='Producto agregado*';


                if($exist)
                {
                        if($product->stock < $cant)
                        {
                                $this->emit('no-stock','Stock insuficiente *');
                                return;
                        }
                }


                $this->removeItem($product->id);

                if($cant > 0)
                {
                    Cart::add($product->id, $product->nombre, $product->pvp, $cant, $product->descuento->porcentaje, $product->impuestos);
                    $this->total = Cart::getTotal();
                    $this->itemsQuantity = Cart::getTotalQuantity();
                    $this->emit('scan-ok', $title);

                }


        }

        public function removeItem($productId)
        {
                Cart::remove($productId);

                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();

                $this->emit('scan-ok', 'Producto eliminado*');
        }

        public function decreaseQuantity($productId)
        {
            $item = Cart::get($productId);
            Cart::remove($productId);
            // si el producto no tiene descuento, mostramos uno por default
            $desc = (count($item->attributes) > 0 ? $item->attributes[0] : '0');
            $producto  =  Producto::find($productId);
            $item->conditions[0] = $producto->impuestos;

            $newQty = ($item->quantity) - 1;

            if($newQty > 0)

                   //dd($item->conditions[0]);
                    Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0],$item->conditions[0]);
                    //Cart::add($item->id, $item->name, $item->price, $newQty, $item->attributes[0]);


            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('scan-ok', 'Cantidad actualizada****');


        }

        public function trashCart()
        {
                Cart::clear();
                $this->efectivo =0;
                $this->change =0;
                $this->total = Cart::getTotal();
                $this->itemsQuantity = Cart::getTotalQuantity();
                $this->emit('scan-ok', 'Carrito vacío*');

        }


    }
