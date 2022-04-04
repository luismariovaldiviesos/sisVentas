<div class="row mt-3">
    <div class="col-sm-6">
        <div class="connect-sorting">
            <h5 class="text-center mb-2">Valor</h5>
            <div class="container">
                <div class="row-sm-6">
                    <div class="col-sm mt-2">
						<button wire:click.prevent="ACash({{$valorIngresado}})" class="btn btn-dark btn-block den">
							{{ $valorIngresado >0 ? '$' . number_format($valorIngresado,2, '.', '') : 'Exacto' }}
						</button>
					</div>
                </div>
            </div>

        </div>
    </div>
    <div class="col-sm-6">
        <div class="connect-sorting">
            <span class="input-group-text input-gp hideonsm" style="background: #3B3F5C; color:white">Efectivo F8
            </span>
            <input
            type="number" id="cash"
			wire:model="efectivo"
			wire:keydown.enter="saveSale"
			class="form-control text-center" value="{{$valorIngresado}}"
			>


        </div>
    </div>
</div>
