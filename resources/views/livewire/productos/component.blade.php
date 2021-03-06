<div class="row sales layout-top-spacing">

	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">

					<li>
                        @can('importar_producto')
                            <a href="{{url('import')}}" class="tabmenu bg-dark mr-3">Importar</a>
                        @endcan


                        @can('crear_producto')
						    <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
						@endcan
					</li>

				</ul>
			</div>
			@can('buscar_producto')
			@include('common.searchbox')
			@endcan
			<div class="widget-content">

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #3B3F5C;">
							<tr>
								<th class="table-th text-white">DESCRIPCIÓN</th>
								<th class="table-th text-white text-center">CODIGO de barras</th>
								<th class="table-th text-white text-center">CATEGORIA</th>
                                <th class="table-th text-white text-center">STOCK</th>
								<th class="table-th text-white text-center">INV.MIN</th>
								<th class="table-th text-white text-center">PRECIO</th>
                                <th class="table-th text-white text-center">DECUENTOS</th>
								<th class="table-th text-white text-center">IMPUESTOS</th>
                                <th class="table-th text-white text-center">PRECIO VENTA</th>
                                <th class="table-th text-white text-center">PROVEEDOR</th>
								<th class="table-th text-white text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $product)
							<tr>
                                {{-- DESCRIPCION --}}
								<td>
									<span class="badge badge-warning"><h6 class="text-left text-white">{{$product->nombre}}</h6></span>
								</td>
                                {{-- --------------------- --}}

                                {{-- CODIFO DE  BARRAS --}}
								<td class="text-center">
									<span class="badge badge-dark"><h6 class="text-center text-white">{{$product->barcode}}</h6></span>
								</td>
                                {{-- --------------------- --}}



                                {{-- CATEGORIA --}}
								<td class="text-center">
									<h6 class="text-center">{{$product->categoria}}</h6>
								</td>
                                {{-- --------------------- --}}

                                {{-- STOCK  --}}
								<td class="text-center">
									<h6 class="text-center {{$product->stock <= $product->alerts ? 'text-danger' : '' }} ">
										{{$product->stock}}
									</h6>
								</td>
                                {{-- --------------------- --}}

                                {{-- STOCK MINIMO  --}}
								<td class="text-center">
									<h6 class="text-center">{{$product->alertas}}</h6>
								</td>
                                {{-- --------------------- --}}

                                 {{-- PRECIO --}}
                                 <td class="text-center">
                                    <span class="badge badge-warning"><h6 class="text-center text-white">{{$product->precio }}</h6></span>
                                </td>
                                {{-- --------------------- --}}

                                        {{-- --------------------- --}}

                                 {{-- descuento  --}}
                                 <td class="text-center">
                                    <span class="badge badge-info"><h6 class="text-center text-white">{{$product->descuento->porcentaje}}%</h6></span>
								</td>
                                {{-- --------------------- --}}

                                {{-- IMPUESTOS  --}}
                                <td class="text-center">
                                    @if (count($product->impuestos) > 0)
                                        @foreach ($product->impuestos as $imp )
                                        <span class="badge badge-info"><h6 class="text-center text-white">{{$imp->nombre}} {{$imp->porcentaje}}%</h6></span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-info"><h6 class="text-center text-white">S-I</h6></span>
                                     @endif
								</td>


                                {{-- PVP  --}}
                                <td class="text-center">
                                     <span class="badge badge-warning"><h6 class="text-center text-white">{{$product->pvp}}</h6></span>
                               	</td>
                                {{-- --------------------- --}}


                                 {{-- PROVEEDORES  --}}
                                <td class="text-center">
                                    @if (count($product->proveedores)> 0)
                                        @foreach ($product->proveedores as $prov )
                                        <span class="badge badge-success"><h6 class="text-center">{{$prov->nombre}}</h6></span>
                                        @endforeach
                                    @else
                                        <span class="badge badge-info"><h6 class="text-center text-white">S-P</h6></span>

                                    @endif
								</td>
                                 {{-- --------------------- --}}

								<td class="text-center">
									@can('editar_producto')
                                        <a href="javascript:void(0)" wire:click.prevent="Edit({{$product->id}})" class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
									@endcan

									@can('eliminar_producto')
                                        {{-- @if($product->ventas->count() < 1)  --}}
                                            <a href="javascript:void(0)" onclick="Confirm('{{$product->id}}')" class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                            </a>
                                        {{-- @endif --}}
									@endcan
										<button type="button" wire:click.prevent="ScanCode('{{$product->barcode}}')" class="btn btn-dark"><i class="fas fa-shopping-cart"></i></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{$data->links()}}
				</div>

			</div>


		</div>


	</div>

	@include('livewire.productos.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {

		window.livewire.on('product-added', Msg => {
			$('#theModal').modal('hide')
            noty(Msg)
		});
        window.livewire.on('product-error', Msg => {

            noty(Msg, 2)
		});
		window.livewire.on('product-updated', Msg => {
			$('#theModal').modal('hide')
            noty(Msg)

		});
		window.livewire.on('product-deleted', Msg => {
            noty(Msg)
		});
		window.livewire.on('modal-show', Msg => {
			$('#theModal').modal('show')
		});
		window.livewire.on('modal-hide', Msg => {
			$('#theModal').modal('hide')

		});
		window.livewire.on('hidden.bs.modal', Msg => {
			$('.er').css('display', 'none')
		});
		$('#theModal').on('hidden.bs.modal', function(e) {
			$('.er').css('display', 'none')
		})
		$('#theModal').on('shown.bs.modal', function(e) {
			$('.product-name').focus()
		})



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



</script>
