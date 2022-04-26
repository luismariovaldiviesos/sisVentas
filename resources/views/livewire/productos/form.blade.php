@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label >Nombre</label>
            <input type="text" wire:model.lazy="nombre"
            class="form-control product-nombre" autofocus >
            @error('nombre') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Código producto</label>
            <input type="text" wire:model.lazy="barcode"
            class="form-control"
            {{ $selected_id > 0 ? 'disabled' : '' }}
             >
            @error('barcode') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Precio compra</label>
            <input type="text" data-type='currency' wire:model.lazy="costo" class="form-control" >
            @error('costo') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Precio venta</label>
            <input type="text" data-type='currency' wire:model.lazy="precio" class="form-control" >
            @error('precio') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Stock</label>
            <input type="number"  wire:model.lazy="stock" class="form-control" >
            @error('stock') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Alertas</label>
            <input type="number"  wire:model.lazy="alertas" class="form-control" placeholder="ej: 10" >
            @error('alertas') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>


    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Categoría</label>
            <select wire:model='categoria_id' class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}" >{{$categoria->nombre}}</option>
                @endforeach
            </select>
            @error('categoria_id') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Unidad de medida</label>
            <select wire:model='unidad_id' class="form-control">
                <option  disabled>Elegir</option>
                @foreach($unidades as $unidad)
                <option value="{{$unidad->id}}" >{{$unidad->nombre}}</option>
                @endforeach
            </select>
            @error('unidad_id') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>


    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label>Seleeccionar Impuestos</label>
            @foreach($impuestos as $impuesto)
            <div class="mt-1">
                   <label class="inline-flex items-center">
                   <input type="checkbox" value="{{ $impuesto->id }}" wire:model="selectedImpuestos"  class="form-checkbox h-6 w-6 text-green-500">
                        <span class="ml-3 text-sm">{{$impuesto->nombre}} {{$impuesto->porcentaje}}%</span>
                    </label>
               </div>
            @endforeach
            <p>Impuestos en este producto :</p>
            @foreach ($impuestosProductos as $impuestoGravado)
            <span class="ml-3 text-sm">{{$impuestoGravado->nombre}} {{$impuestoGravado->porcentaje}}%</span>
            @endforeach
            {{-- @error('categoryid') <span class="text-danger er">{{ $message}}</span>@enderror --}}
        </div>
    </div>

    <div class="col-sm-12 col-md-12">
        <div class="form-group">
            <label>Proveedor</label>
            @foreach($proveedores as $proveedor)
            <div class="mt-1">
                   <label class="inline-flex items-center">
                   <input type="checkbox" value="{{ $proveedor->id }}" wire:model="selectedProveedores"  class="form-checkbox h-6 w-6 text-green-500">
                        <span class="ml-3 text-sm">{{$proveedor->nombre}}</span>
                    </label>
               </div>
            @endforeach
            {{-- @error('categoryid') <span class="text-danger er">{{ $message}}</span>@enderror --}}
        </div>
    </div>
</div>

{{-- <div class="row mt-3">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-bordered table striped mt-1">
                <thead class="text-white" style="background: #3B3F5C">
                    <tr>
                        <th class="table-th text-white text-center">ID</th>
                        <th class="table-th text-white text-center">NOMBRE</th>
                        <th class="table-th text-white text-center">PORCENTAJE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($impuestos as $impuesto)
                    <tr>
                        <td><h6 class="text-center">{{$impuesto->id}}</h6></td>
                        <td class="text-center">
                            <div class="n-check">
                                <label class="new-control new-checkbox checkbox-primary">
                                    <input type="checkbox"
                                    wire:change="syncPermiso($('#p' + {{ $impuesto->id }}).is(':checked'), '{{ $impuesto->nombre}}' )"
                                    id="p{{ $impuesto->id }}"
                                    value="{{ $impuesto->id }}"
                                    class="new-control-input"
                                    {{ $impuesto->checked == 1 ? 'checked' : '' }}
                                    >
                                    <span class="new-control-indicator"></span>
                                    <h6>{{ $impuesto->nombre}}</h6>
                                </label>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div> --}}



@include('common.modalFooter')
