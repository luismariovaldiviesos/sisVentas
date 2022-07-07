<div class="connect-sorting-content">
	<div class="card simple-title-task ui-sortable-handle">
		<div class="card-body">
		@if($total > 0)
            <div class="table-responsive tblscroll" style="max-height: 650px; overflow: hidden">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>

                            <th class="table-th text-left text-white">Código Pr.</th>
                            <th class="table-th text-center text-white">Descripción</th>
                            <th width="13%" class="table-th text-center text-white">Cant.</th>
                            <th class="table-th text-center text-white">Precio Uni</th>
                            <th class="table-th text-center text-white">Dscto</th>
                            <th class="table-th text-center text-white">impuestos</th>
                            <th class="table-th text-center text-white">precio Total</th>
                            <th class="table-th text-center text-white">MODELO</th>
                            <th class="table-th text-center text-white">acciones</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($cart as $item )
                        <tr>
                            <td><h6>{{$item->id}}</h6></td>
                            <td><h6>{{$item->name}}</h6></td>
                            <td>
                            {{-- CANTIDAD  --}}
                                <input type="number" id="r{{$item->id}}"
                                wire:change="updateQty({{$item->id}}, $('#r' + {{$item->id}}).val() )"
                                style="font-size: 1rem!important"
                                class="form-control text-center"
                                value="{{$item->quantity}}"
                                >
                            </td>

                            {{-- precio --}}
                            <td class="text-center">${{number_format($item->price,2)}}</td>
                           {{-- fin precio  --}}


                             {{-- descuento --}}

                           <td class="text-center">
                                @if (count($item->attributes) > 0)
                                    <span>
                                    <p>{{ $item->attributes[0] }}</p>
                                    </span>
                                @endif
                           </td>


                           {{-- impuestos --}}


                           <td class="text-center">

                            @if (count($item->conditions) > 0)
                            <span>
                           @foreach ($item->conditions as $condi )
                               <p>{{ $condi->nombre }}</p>
                           @endforeach
                            </span>
                        @endif

                            </td>



                         {{-- TOTAL --}}

                                <td class="text-center">
                                    <h6>
                                        ${{number_format($item->price * $item->quantity,2)}}
                                    </h6>
                                </td>

                                {{-- con el metodo associatedModel se peude llamar a los metodos del modelo (producto en este caso)  --}}
                                <td class="text-center">
                                    <h6>
                                        {{$item->associatedModel->calculaImpuestos()}}
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


                    </tbody>


                </table>

                <tfoot>

                    <div class="row mt-4 connect-sorting">
                        <div class="form-group col-lg-2 col-md-2 col-sm-12">
                            <h7 class="text-info">SUBTOTAL</h7>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                                </div>
                                <input type="text" value="{{ $total }}" wire:model.lazy="total" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-12">
                            <h7 class="text-info">IVA 0%</h7>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                                </div>
                                <input type="text" wire:model.lazy="tipoidentificacion" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-12">
                            <h7 class="text-info">IVA 12%</h7>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                                </div>
                                <input type="text" wire:model.lazy="tipoidentificacion" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-12">
                            <h7 class="text-info">DESCUENTO</h7>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                                </div>
                                <input type="text" wire:model.lazy="tipoidentificacion" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-12">
                            <h7 class="text-info">VALOR TOTAL</h7>
                            <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                                </div>
                                <input type="text" wire:model.lazy="tipoidentificacion" class="form-control">
                            </div>
                        </div>
                    </div>

                    {{-- <tr>
                        <td colspan="6" rowspan="5"></td>
                        <td>SUBTOTAL</td>
                        <td><input type="text" name="subtotal" value="{{ $total }}"></td>
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
                  </tr> --}}




            </tfoot>

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
