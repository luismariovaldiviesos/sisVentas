@include('common.modalHead')

<div class="row">



<div class="col-sm-12 col-md-6">
	<div class="form-group">
		<label >Porcentaje</label>
		<input type="text" wire:model.lazy="porcentaje"
		class="form-control" placeholder="ej: 12" autofocus >
		@error('porcentaje') <span class="text-danger er">{{ $message}}</span>@enderror
	</div>
</div>



</div>

@include('common.modalFooter')
