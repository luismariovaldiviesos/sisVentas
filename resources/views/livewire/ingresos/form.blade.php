{{-- @include('common.modalHead')

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
        <select wire:model='producto_id' class="form-control" data-live-search="true">
            <option value="Elegir" disabled>Elegir</option>
            @foreach($productos as $producto)
            <option value="{{$producto->id}}" >{{$producto->nombre}}</option>
            @endforeach
        </select>
        @error('producto_id') <span class="text-danger er">{{ $message}}</span>@enderror
    </div>
</div>

<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >cANTIDAD</label>
		<input type="text" wire:model.lazy="cantidad"
		class="form-control" placeholder="001-002-003" autofocus >
		@error('cantidad') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>
<div class="col-sm-12 col-md-4">
	<div class="form-group">
		<label >Total por calcular</label>
		<input type="text" wire:model.lazy="total"
		class="form-control" placeholder="001-002-003" autofocus >
		@error('total') <span class="text-danger er">{{ $message}}</span>@enderror
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
</div>

</div>

@include('common.modalFooter') --}}




{{-- <div class="row">

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >Producto</label>
            <div class="form-group">

                <select wire:model="producto_id" class="form-control">
                    <option value="Elegir" selected>Elegir</option>
                    @foreach ($productos as $p )
                    <option value="{{ $p->id }}" >{{ $p->nombre }}</option>
                    @endforeach
                </select>
                @error('producto_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
     </div>

     <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <div class="form-group">
                <label >Cantidad</label>
                <input type="text" wire:model.lazy="cantidad"
                class="form-control" placeholder="001-002-003" autofocus >
                @error('cantidad') <span class="text-danger er">{{ $message}}</span>@enderror
            </div>
        </div>
     </div>

     <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <div class="form-group">
                <label >P. Compra</label>
                <input type="text" wire:model.lazy="total"
                class="form-control" placeholder="001-002-003" autofocus >
                @error('total') <span class="text-danger er">{{ $message}}</span>@enderror
            </div>
        </div>
     </div>

     <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <div class="form-group">
                <label >Total</label>
                <input type="text" wire:model.lazy="total"
                class="form-control" placeholder="001-002-003" autofocus >
                @error('total') <span class="text-danger er">{{ $message}}</span>@enderror
            </div>
        </div>
     </div>

</div>


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




--}}
