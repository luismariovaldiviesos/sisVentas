<div class="row sales layout-top-spacing">

	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">

					<li>
						<a href="{{url('import')}}" class="tabmenu bg-dark mr-3">Importar</a>
						@can('crear_proveedor')
						<a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
						@endcan
					</li>

				</ul>
			</div>
			@can('buscar_proveedor')
			@include('common.searchbox')
			@endcan
			<div class="widget-content">

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #3B3F5C;">
							<tr>
								<th class="table-th text-white">NOMBRE</th>
								<th class="table-th text-white text-center">RUC</th>
								<th class="table-th text-white text-center">EMAIL</th>
								<th class="table-th text-white text-center">DIRECCION</th>
								<th class="table-th text-white text-center">TELEFONO</th>
								<th class="table-th text-white text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $provee)
							<tr>
								<td>
									<h6 class="text-left">{{$provee->nombre}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$provee->ruc}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$provee->email}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$provee->direccion}}</h6>
								</td>
                                <td>
									<h6 class="text-center">{{$provee->telefono}}</h6>
								</td>


								{{-- <td>
									<h6 class="text-center {{$provee->stock <= $product->alerts ? 'text-danger' : '' }} ">
										{{$product->stock}}
									</h6>
								</td> --}}


								{{-- <td>
									<h6 class="text-center">{{$product->alertas}}</h6>
								</td> --}}

								{{-- <td class="text-center">
                                    @foreach ($product->impuestos as $imp )
                                   <span class="badge badge-success"><h6 class="text-center">{{$imp->nombre}}-{{$imp->porcentaje}}%</h6></span>
                                    @endforeach
								</td> --}}

								<td class="text-center">
									@can('editar_proveedor')
									<a href="javascript:void(0)" wire:click.prevent="Edit({{$provee->id}})" class="btn btn-dark mtmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>

									@endcan
									@can('eliminar_proveedor')
									{{-- @if($product->ventas->count() < 1)  --}}
                                        <a href="javascript:void(0)" onclick="Confirm('{{$provee->id}}')" class="btn btn-dark" title="Delete">
										<i class="fas fa-trash"></i>
										</a>
									{{-- @endif --}}
										@endcan

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

	@include('livewire.proveedores.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {

		window.livewire.on('proveedor-added', Msg => {
			$('#theModal').modal('hide')
            noty(Msg)
		});
		window.livewire.on('proveedor-updated', Msg => {
			$('#theModal').modal('hide')
            noty(Msg)
		});
		window.livewire.on('proveedor-deleted', Msg => {
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
