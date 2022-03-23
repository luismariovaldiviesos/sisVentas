@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label >Razón Social</label>
            <input type="text" wire:model.lazy="razonsocial"
            class="form-control" placeholder="ej: Luis Valdivieso"  >
            @error('razonsocial') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="mt-2 col-sm-4">
        <div class="form-group">
            <label>Tipo Identificador</label>
            <select wire:model.lazy='tipoidentificacion' class="form-control">
                <option value="Elegir" disabled>Elegir</option>
                <option value="ruc" >RUC</option>
                <option value="ci" >CI</option>
                <option value="pasaporte" >PASAPORTE</option>
                <option value="otros" >otros</option>
            </select>
            @error('tipoidentificacion') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Ruc-Ci</label>
            <input type="text" wire:model.lazy="valoridentificacion"
            class="form-control" placeholder="ej: 0101010101001"  >
            @error('valoridentificacion') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label >Direccion</label>
            <input type="text" wire:model.lazy="direccion"
            class="form-control" placeholder="ej: Dávila Chica"  >
            @error('direccion') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <label >Teléfono</label>
            <input type="text" wire:model.lazy="telefono"
            class="form-control" placeholder="ej: 0987308688" maxlength="10" >
            @error('telefono') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

    <div class="col-sm-12 col-md-6">
        <div class="form-group">
            <label >Email</label>
            <input type="text" wire:model.lazy="email"
            class="form-control" placeholder="ej: cliente@mail.com"  >
            @error('email') <span class="text-danger er">{{ $message}}</span>@enderror
        </div>
    </div>

</div>


@include('common.modalFooter')
