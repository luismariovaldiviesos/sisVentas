@include('common.modalHead')

<div class="row">

    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label>Proveedor</label>
            <select wire:model='proveedor_id' class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                @foreach($proveedores as $proveedor)
                <option value="{{$proveedor->id}}" >{{$proveedor->nombre}}</option>
                @endforeach
            </select>
            @error('proveedor_id') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-4">
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

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Valor</label>
		<input type="text" wire:model.lazy="valoridentificador"
		class="form-control" placeholder="001-002-003" autofocus >
		@error('valoridentificador') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>



<div class="col-sm-12 col-md-4">
    <div class="form-group">
        <label>Producto</label>
        <select wire:model='producto_id' class="form-control selectpicker" data-live-search="true">
            <option value="Elegir" disabled>Elegir</option>
            @foreach($productos as $producto)
            <option value="{{$producto->id}}" >{{$producto->nombre}}</option>
            @endforeach
        </select>
        @error('producto_id') <span class="text-danger er">{{ $message}}</span>@enderror
    </div>
</div>


{{-- <div class="col-sm-12 col-md-4">
    <div class="form-group">
        <label for="">Producto</label>
        <select class="form-control selectpicker" id="" data-live-search="true">
            <option value="Elegir" disabled>Elegir</option>
            <option value="factura" >Factura</option>
            <option value="nota de venta" >Nota de Venta</option>
            <option value="guia" >Guia</option>
            <option value="otrs" >otros</option>
        </select>
    </div>
</div> --}}

</div>

@include('common.modalFooter')
