<h5 class="text-center mb-3">DATOS CLIENTE</h5>
<div class="input-group" x-data="{ isOpen: true }" @click.away="isOpen = false">
    <div class="input-group-text"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
        class="feather feather-search toggle-search">
        <circle cx="11" cy="11" r="8"></circle>
        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
    </div>
    <input type="text" class="form-control"  placeholder="Buscar cliente"
        wire:model='buscarCliente'
        @focus="isOpen = true"
        @keydown.escape.window="isOpen = false"
        @keydown.shift.tab="isOpen = false"
    >
    <div class="input-group-prepend">
        <div class="input-group-text">
            <i wire:click.prevent="limpiarCliente()" class="la la-trash la-lg">
                Limpiar
            </i>

        </div>
    </div>

    <ul class="list-group">
        @if ($buscarCliente != '')
            @foreach($clientes as $r)
            <li wire:click="mostrarCliente('{{$r}}')" class="list-group-item list-group-item-action">
                <b>{{$r->nombre}}</b> - <h7 class="text-info">ruc/ci</h7>:{{$r->valoridentificacion }}
            </li>
            @endforeach
            @endif

    </ul>


    <div class="row mt-4">

        <div class="form-group col-lg-10 col-md-10 col-sm-12">
            <h7 class="text-info">Razón Social* </h7>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div  class="input-group-text"><i class="la la-user la-lg"></i></div>
                </div>
                <input type="text" wire:model.lazy="razonsocial"  class="form-control" >

            </div>
        </div>
        <div class="form-group col-lg-2 col-md-2 col-sm-12">
            <h7 class="text-info">Tipo Doc</h7>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="la la-phone la-lg"></i></div>
                </div>
                <input type="text" wire:model.lazy="tipoidentificacion" class="form-control">
            </div>
        </div>
        <div class="form-group col-lg-4 col-md-2 col-sm-12">
            <h7 class="text-info">Valor Doc</h7>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="la la-mobile la-lg"></i></div>
                </div>
                <input type="text" wire:model.lazy="valoridentificacion" class="form-control">
            </div>
        </div>
        <div class="form-group col-lg-5 col-md-4 col-sm-12">
            <h7 class="text-info">E-Mail</h7>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="la la-envelope la-lg"></i></div>
                </div>
                <input type="text" wire:model.lazy="email" class="form-control">
            </div>
        </div>
        <div class="col-sm-3">
            <h7 class="text-info">Teléfono*</h7>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="la la-home la-lg"></i></div>
                </div>
                <input type="text" wire:model.lazy="telefono" class="form-control" maxlength="255"  placeholder="">
            </div>
        </div>
    </div>

</div>

