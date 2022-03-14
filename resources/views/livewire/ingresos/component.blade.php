<div class="row sales layout-top-spacing">

	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">

					<li>

						@can('crear_ingreso')
						<a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#modalIngreso">Agregar</a>
						@endcan
					</li>

				</ul>
			</div>
			@can('buscar_ingreso')
			@include('common.searchbox')
			@endcan

            @can('ver_ingreso')


			<div class="widget-content">

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #3B3F5C;">
							<tr>
								<th class="table-th text-white">PROVEEDOR</th>
								<th class="table-th text-white text-center">USUARIO</th>
								<th class="table-th text-white text-center">NUMERO INGRESO</th>
                                <th class="table-th text-white text-center">FECHA INGRESO</th>
								<th class="table-th text-white text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $ingreso)
							<tr>
								<td>
									<h6 class="text-left">{{$ingreso->proveedor->nombre}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$ingreso->usuario->name}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$ingreso->valoridentificador}}</h6>
								</td>
                                <td>
									<h6 class="text-center">{{$ingreso->created_at}}</h6>
								</td>

								<td class="text-center">
									@can('editar_ingreso')
									<a href="javascript:void(0)" wire:click.prevent="Edit({{$ingreso->id}})" class="btn btn-dark mtmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>

									@endcan
									@can('eliminar_ingreso')
									 <a href="javascript:void(0)" onclick="Confirm('{{$ingreso->id}}')" class="btn btn-dark" title="Delete">
										<i class="fas fa-trash"></i>
									</a>
									@endcan

                                    @can('eliminar_ingreso')
									 <a href="javascript:void(0)" onclick="Confirm('{{$ingreso->id}}')" class="btn btn-dark" title="Delete">
                                        <i class="fas fa-list"></i>
									</a>
									@endcan




								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$data->links()}}
				</div>

			</div>

            @endcan


		</div>


	</div>

	{{-- @include('livewire.ingresos.form') --}}
</div>



{{-- MODAL PÁRA INGRESOS --}}

<div wire:ignore.self class="modal fade" id="modalIngreso" tabindex="-1" role="dialog" >
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="text-white modal-title">
              <b>Nuevo ingreso</b>
          </h5>

        </div>
        <div class="modal-body">

            <div class="row">
                 <div class="col-sm-12 col-md-12">
                    <div class="form-group">
                        <label >Proveedor</label>
                        <div class="form-group">

                            <select wire:model="proveedor_id" class="form-control">
                                <option value="Elegir" selected>Elegir</option>
                                @foreach ($proveedores as $p )
                                <option value="{{ $p->id }}" >{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                            @error('proveedor_id') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                 </div>


                   <div class="mt-2 col-sm-6">
                        <div class="form-group">
                            <label>Tipo Identificador</label>
                            <select wire:model='tipoidentificador' class="form-control">
                                <option value="Elegir" disabled>Elegir</option>
                                <option value="factura" >Factura</option>
                                <option value="nota de venta" >Nota de Venta</option>
                                <option value="guia" >Guia</option>
                                <option value="otrs" >otros</option>
                            </select>
                            @error('proveedor_id') <span class="text-danger er">{{ $message}}</span>@enderror
                        </div>
                    </div>

                    <div class="mt-2 col-sm-6">

                        <div class="form-group">
                            <label >Valor Identificador</label>
                            <input type="text" wire:model.lazy="valoridentificador"
                            class="form-control" placeholder="001-002-003" autofocus >
                            @error('valoridentificador') <span class="text-danger er">{{ $message}}</span>@enderror
                        </div>
                    </div>

            </div>

            <br><br>

            {{-- <div class="row">
                <div class="col-sm-12 col-md-4">
                    <button type="button"  class="btn btn-dark close-modal">
                        AGREGAR DETALLE
                    </button>
                </div>
            </div> --}}

            <br>


            {{-- TABLA PARA EL DETALLE  --}}

            <div class="row">

                <div class="mt-2 col-sm-6">
                    <label for="">Producto</label>
                    <select wire:model="producto_id" class="form-control" name="producto_id" id="producto_id">
                        <option value="Elegir" selected>Elegir</option>
                        @foreach ($productos as $p )
                        <option value="{{ $p->id }}" >{{ $p->nombre }}</option>
                        @endforeach
                    </select>
                    @error('producto_id') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="mt-2 col-sm-2">
                    <label >Cantidad</label>
                    <input type="number" wire:model.lazy="cantidad"
                    class="form-control" autofocus name="cantidad" id="cantidad" >
                    @error('cantidad') <span class="text-danger er">{{ $message}}</span>@enderror
                </div>

                <div class="mt-2 col-sm-2">
                    <label >P. Compra</label>
                    <input type="number" wire:model.lazy="preciocompra"
                    class="form-control" autofocus  name="preciocompra" id="preciocompra">
                    @error('total') <span class="text-danger er">{{ $message}}</span>@enderror
                </div>
{{--
                <div class="mt-2 col-sm-2">
                    <label >Total </label>
                    <input type="text" wire:model.lazy="total"
                    class="form-control" autofocus name="total" id="total">
                    @error('total') <span class="text-danger er">{{ $message}}</span>@enderror
                </div> --}}
                <br>
                <div class="mt-2 col-sm-2">
                    <label >Agregar </label>
                    <button type="button" id="btn_add"  class="btn btn-primary">+</button>
                </div>

                {{-- TABLA DEL DETALLE  --}}
                <div class="mt-2 col-sm-12">
                    <table id="detalles" class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C;">
                            <th class="table-th text-white text-center">Opciones</th>
                            <th class="table-th text-white text-center">Producto</th>
                            <th class="table-th text-white text-center">Cantidad</th>
                            <th class="table-th text-white text-center">P Compra</th>
                            <th class="table-th text-white text-center">SubTotal</th>
                        </thead>
                        <tfoot>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <th id="total">$ 0.00</th>
                        </tfoot>
                        <tbody>

                        </tbody>
                    </table>
                </div>


            </div>




        </div>
        <div class="modal-footer" id="guardar">
            <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
                data-dismiss="modal">
                CERRAR
            </button>

            {{-- @if ($selected_id < 1) --}}
                {{-- <button type="button" wire:click.prevent="guardarIngreso()" class="btn btn-dark close-modal">
                    GUARDAR
                </button> --}}


        </div>
    </div>
    </div>
</div>



<script>
	document.addEventListener('DOMContentLoaded', function() {

		window.livewire.on('impuesto-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('impuesto-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('impuesto-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })

		window.livewire.on('show-modal', msg => {
			$('#theModal').modal('show')
		});
		window.livewire.on('modal-hide', msg => {
			$('#theModal').modal('hide')
		});

        $('#btn_add').click(function(){
        agregar();
    });


    $('#guardar').hide();

	});



	function Confirm(id) {

		swal({
			title: 'CONFIRMAR',
			text: '¿CONFIRMAS ELIMINAR EL REGISTRO?',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cerrar',
			cancelButtonColor: '#fff',
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar'
		}).then(function(result) {
			if (result.value) {
				window.livewire.emit('deleteRow', id)
				swal.close()
			}

		})
	}


// CODIGO PARA SUMAR DETALLES



// $(document).ready(function(){

// });


var cont =0;
    total = 0;
    subtotal= [];

    function  agregar()
    {
        producto_id = $('#producto_id').val();
        producto  = $('#producto_id option:selected').text();
        cantidad = $('#cantidad').val();
        preciocompra = $('#preciocompra').val();


        if (producto_id!="" && cantidad!="" && preciocompra!="")
        {
            console.log(cantidad,preciocompra );
            subtotal[cont]=(cantidad*preciocompra);
            total = total+subtotal[cont];
            var fila  =  '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="id_producto[]" value="'+producto_id+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></td><td><input type="number" name="preciocompra[]" value="'+preciocompra+'"></td><td>'+subtotal[cont]+'</td></tr>';
            cont ++;
            limpiar();
            $("#total").html(total);
            console.log(total);
            evaluar();
            $("#detalles").append(fila);

        }
        else{
            alert("error al ingresar los detalles del ingreso");
        }
    }

    function limpiar(){
        $('#cantidad').val("");
        $('#preciocompra').val("");
    }

    function evaluar()
    {
        if(total > 0){
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }

    function eliminar(index){
        total = total-subtotal[index];
        $("#total").html(total);
        $("#fila" + index).remove();
        evaluar();
    }





</script>

