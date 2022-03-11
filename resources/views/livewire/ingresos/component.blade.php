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
						<a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">Agregar</a>
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

	@include('livewire.ingresos.form')
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

