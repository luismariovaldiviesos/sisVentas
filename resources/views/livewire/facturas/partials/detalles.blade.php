<div class="connect-sorting-content">
	<div class="card simple-title-task ui-sortable-handle">
		<div class="card-body">
		@if($total > 0)
            <div class="table-responsive tblscroll" style="max-height: 650px; overflow: hidden">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>
                            <th width="10%"></th>
                            <th class="table-th text-left text-white">Código Pr.</th>
                            <th class="table-th text-center text-white">Descripción</th>
                            <th width="13%" class="table-th text-center text-white">Cant.</th>
                            <th class="table-th text-center text-white">Precio Uni</th>
                            <th class="table-th text-center text-white">Dscto</th>
                            <th class="table-th text-center text-white">precio Total</th>
                            <th class="table-th text-center text-white">acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($cart as $item )
                        <tr>
                            <td><h6>{{$item->id}}</h6></td>
                            <td><h6>{{$item->descripcion}}</h6></td>
                            <td>
                            {{-- CANTIDAD  --}}
                                <input type="number" id="r{{$item->id}}"
                                wire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}).val() )"
                                style="font-size: 1rem!important"
                                class="form-control text-center"
                                value="{{$item->quantity}}"
                                >
                            </td>

                           <td class="text-center">${{number_format($item->price,2)}}</td>
                           <td class="text-center">${{number_format($item->descuento,2)}}</td>
                           {{-- SUBTOTAL --}}
                                <td class="text-center">
                                    <h6>
                                        ${{number_format($item->price * $item->quantity - $item->descuento,2)}}
                                    </h6>
                                </td>

                             {{-- ACCIONES  --}}

                                <td class="text-center">
                                    <button onclick="Confirm('{{$item->id}}', 'removeItem', '¿CONFIRMAS ELIMINAR EL REGISTRO?')" class="btn btn-dark mbmobile">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button wire:click.prevent="decreaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button wire:click.prevent="increaseQty({{$item->id}})" class="btn btn-dark mbmobile">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                </td>
                          </tr>
                        @endforeach

                        <tr>
                            <td colspan="6" rowspan="5"></td>
                            <td>SUBTOTAL</td>
                            <td><input type="text" name="subtotal"></td>
                          </tr>
                          <tr>
                            <td>IVA 0%</td>
                            <td><input type="text" name="iva0"></td>
                          </tr>
                          <tr>
                            <td>IVA 12</td>
                            <td><input type="text" name="iva12"></td>
                          </tr>
                          <tr>
                            <td>DESCUENTO</td>
                            <td><input type="text" name="descuento"></td>
                          </tr>
                          <tr>
                            <td>VALOR TOTAL</td>
                            <td><input type="text" name="total"></td>
                          </tr>

                    </tbody>
                </table>

            </div>
		@else
		    <h5 class="text-center text-muted">Agrega productos a la venta</h5>
		@endif


		<div wire:loading.inline wire:target="saveSale">
			<h4 class="text-danger text-center">Guardando Venta...</h4>
		</div>




		</div>
	</div>
</div>
