<div class="row sales layout-top-spacing">

    <div class="col-sm-6">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    {{ $empresa[0]->razonSocial }}
                </h4>
            </div>
            <div class="widget-content">
                @can('ver_empresa')
                <div class="row">
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label >RUC</label>
                            <h5>{{ $empresa[0]->ruc }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label >Direccion Matriz</label>
                            <h5>{{ $empresa[0]->dirMatriz }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label >Direccion Sucursal</label>
                            <h5>{{ $empresa[0]->dirEstablecimiento }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label >Teléfono</label>
                            <h5>{{ $empresa[0]->telefono }}</h5>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="form-group">
                            <label >Correo</label>
                            <h5>{{ $empresa[0]->email }}</h5>
                        </div>
                    </div>
                </div>

            </div>


        </div>
        <br>
        @endcan
    </div>
    <div class="col-sm-6">
        <div class="widget widget-chart-one">

             @include('livewire.facturas.cabecera')

        </div>
    </div>

    <div class="col-sm-6">
        <div class="widget widget-chart-one">

             @include('livewire.facturas.buscaCliente')

        </div>
    </div>


    <div class="col-sm-6">
        <div class="widget widget-chart-one">

             @include('livewire.facturas.resumenventa')

        </div>
    </div>

<br><br><br>
    <div class="col-sm-12 col-md-12 mt-4">
        <!-- DETALLES -->
        @include('livewire.facturas.detalles')
    </div>




</div>


<script>

    document.addEventListener('DOMContentLoaded', function(){



        window.livewire.on('empresa-added', Msg=> {
            noty(Msg)
        })

        window.livewire.on('permiso-exists', Msg=> {
            noty(Msg)
        })
        window.livewire.on('permiso-error', Msg=> {
            noty(Msg)
        })
        window.livewire.on('hide-modal', Msg=> {
            $('#theModal').modal('hide')
        })
        window.livewire.on('show-modal', Msg=> {
            $('#theModal').modal('show')
        })




    });

    function Confirm(id)
     {
         swal({
             title: 'CONFIRMAR',
             text: '¿ DESEA ELIMINAR EL REGISTRO ?',
             type: 'warning',
             showCancelButton: true,
             cancelButtonText: 'Cerrar',
             cancelButtonColor: '#fff',
             confirmButtonColor: '#3B3F5C',
             confirmButtonText: 'Aceptar'
         }).then(function(result){
             if(result.value)
             {
                 window.livewire.emit('destroy', id) //deleteRow va al listener del controller
                 swal.close()
             }
         })
     }

</script>
