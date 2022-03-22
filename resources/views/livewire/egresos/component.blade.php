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
								<th class="table-th text-white text-center">NUMERO EGRESO</th>
                                <th class="table-th text-white text-center">FECHA EGRESO</th>
                                <th class="table-th text-white text-center">TOTAL EGRESO</th>
                                <th class="table-th text-white text-center">OBSERVACIONES</th>
								<th class="table-th text-white text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $egreso)
							<tr>
								<td>
									<h6 class="text-left">{{$egreso->proveedor->nombre}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$egreso->user->name}}</h6>
								</td>
								<td>
									<h6 class="text-center">{{$egreso->valoridentificador}}</h6>
								</td>
                                <td>
									<h6 class="text-center">{{\Carbon\Carbon::parse($egreso->created_at)->isoFormat('LL')}}</h6>
								</td>
                                <td>
									<h6 class="text-center">${{$egreso->totalegreso}}</h6>
								</td>
                                <td class='text-center'><textarea readonly class="form-control">{{ $egreso->observaciones }}</textarea></td>

								<td class="text-center">

                                    @can('detalle_egreso')
                                    <button wire:click.prevent="detalleEgreso({{$egreso->id}})"
                                        class="btn btn-dark btn-sm">
                                        <i class="fas fa-list"></i>
                                    </button>
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

    @include('livewire.egresos.egreso_detalles')
	@include('livewire.egresos.form')


</div>



{{-- MODAL PÁRA INGRESOS --}}





<script>
	document.addEventListener('DOMContentLoaded', function() {

		window.livewire.on('egreso-ok', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('impuesto-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('show-modal2', msg => {
			$('#detallesModal').modal('show')
		});
        window.livewire.on('impuesto-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        })
        window.livewire.on('egreso-error', Msg => {
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



	function Confirm() {

		swal({
			title: 'CONFIRMAR',
			text: '¿CONFIRMAS GUARDAR EL EGRESO?',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cerrar',
			cancelButtonColor: '#fff',
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar'
		}).then(function(result) {
			if (result.value) {
				window.livewire.emit('guardaEgreso',arregloproductos,arreglocantidades,arreglosprecioscompra,totalegreso)
				swal.close()
			}

		})
	}




// CODIGO PARA SUMAR DETALLES



var cont =0;
    totalegreso = 0;
    subtotal= [];
    arregloproductos =[];
    arreglocantidades = [];
    arreglosprecioscompra = [];

    function  agregar()
    {
        producto_id = $('#producto_id').val();
        producto  = $('#producto_id option:selected').text();
        cantidad = $('#cantidad').val();
        preciocompra = $('#preciocompra').val();


        if (producto_id!="" && cantidad!="" && preciocompra!="")
        {
            subtotal[cont]=(cantidad*preciocompra);
            totalegreso = totalegreso+subtotal[cont];
            var fila  =  '<tr class="selected" id="fila'+cont+'"><td><button type="button" class="btn btn-warning" onclick="eliminar('+cont+');">X</button></td><td><input type="hidden" name="arregloproductos[]" value="'+producto_id+'">'+producto+'</td><td><input type="number" name="cantidad[]" value="'+cantidad+'"></td></td><td><input type="number" name="arreglosprecioscompra[]" value="'+preciocompra+'"></td><td>'+subtotal[cont]+'</td></tr>';
            arregloproductos[cont] =  producto_id;
            arreglocantidades[cont] = cantidad;
            arreglosprecioscompra[cont] = preciocompra;
            cont ++;
            limpiar();
            $("#total").html(totalegreso);
            evaluar();
            $("#detalles").append(fila);
            console.log('ides productos' + ' ' + arregloproductos);
            console.log('arreglocantidades ingresos' + ' ' + arreglocantidades);



        }
        else{
            alert("error al ingresar los detalles del egreso");
        }
    }

    function limpiar(){
        $('#cantidad').val("");
        $('#preciocompra').val("");
        $('#producto_id').val("Elegir");
    }

    function evaluar()
    {
        if(totalegreso > 0){
            $('#guardar').show();
        }
        else
        {
            $('#guardar').hide();
        }
    }

    function eliminar(index){
        totalegreso = totalegreso-subtotal[index];
        $("#total").html(totalegreso);
        $("#fila" + index).remove();
        evaluar();
    }

</script>

