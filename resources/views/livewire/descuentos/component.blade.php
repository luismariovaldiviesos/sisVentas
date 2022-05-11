<div class="row sales layout-top-spacing">

	<div class="col-sm-12">
		<div class="widget widget-chart-one">
			<div class="widget-heading">
				<h4 class="card-title">
					<b>{{$componentName}} | {{$pageTitle}}</b>
				</h4>
				<ul class="tabs tab-pills">

					<li>

						@can('crear_impuesto')
						<a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
						@endcan
					</li>

				</ul>
			</div>
			@can('buscar_impuesto')
			@include('common.searchbox')
			@endcan

            @can('ver_impuesto')


			<div class="widget-content">

				<div class="table-responsive">
					<table class="table table-bordered table striped mt-1">
						<thead class="text-white" style="background: #3B3F5C;">
							<tr>
                                <th class="table-th text-white text-center">ID</th>
								<th class="table-th text-white text-center">PORCENTAJE</th>
								<th class="table-th text-white text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $descuento)
							<tr>
                                <td>
									<h6 class="text-center">{{$descuento->id}}</h6>
								</td>

								<td>
									<h6 class="text-center">{{$descuento->porcentaje}}</h6>
								</td>


								<td class="text-center">
									@can('editar_descuento')
									<a href="javascript:void(0)" wire:click.prevent="Edit({{$descuento->id}})" class="btn btn-dark mtmobile" title="Edit">
										<i class="fas fa-edit"></i>
									</a>

									@endcan
									@can('eliminar_descuento')
									 <a href="javascript:void(0)" onclick="Confirm('{{$descuento->id}}')" class="btn btn-dark" title="Delete">
										<i class="fas fa-trash"></i>
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

	@include('livewire.descuentos.form')
</div>


<script>
	document.addEventListener('DOMContentLoaded', function() {

		window.livewire.on('descuento-added', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('descuento-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('descuento-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })

		window.livewire.on('show-modal', msg => {
			$('#theModal').modal('show')
		});
		window.livewire.on('modal-hide', msg => {
			$('#theModal').modal('hide')
		});

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
