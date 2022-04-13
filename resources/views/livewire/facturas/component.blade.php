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

             @include('livewire.facturas.partials.cabecera')

        </div>
    </div>

    <div class="col-sm-6">
        <div class="widget widget-chart-one">

             @include('livewire.facturas.partials.buscaCliente')

        </div>
    </div>


    <div class="col-sm-6">
        <div class="widget widget-chart-one">

             @include('livewire.facturas.partials.resumenventa')
             @include('livewire.facturas.partials.monedas')

        </div>
    </div>

<br><br><br>
    <div class="col-sm-12 col-md-12 mt-4">
        <!-- DETALLES -->
        @include('livewire.facturas.partials.detalles')
    </div>




</div>

<script src="{{ asset('js/keypress.js') }}"></script>
<script src="{{ asset('js/onscan.js') }}"></script>


<script>

try{

    onScan.attachTo(document, {
    suffixKeyCodes: [13],
    onScan: function(barcode) {
        console.log(barcode)
        window.livewire.emit('scan-code', barcode)
    },
    onScanError: function(e){
        //console.log(e)
    }

    })

    console.log('Scanner  listo ctm !')


    } catch(e){
    console.log('Error de lectura: ', e)
    }



</script>

@include('livewire.facturas.scripts.shortcuts')
@include('livewire.facturas.scripts.events')
@include('livewire.facturas.scripts.general')
