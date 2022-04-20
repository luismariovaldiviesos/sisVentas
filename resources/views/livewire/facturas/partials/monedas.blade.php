<div class="row mt-3">
    <div class="col-sm-6">
        <div class="input-group input-group-md mb-3">
            <div class="input-group-prepend">

                <span class="input-group-text input-gp hideonsm" style="background: #3B3F5C; color:white">Efectivo F8
                </span>
            </div>
            <input type="number" id="cash"
            wire:model="efectivo"
            wire:keydown.enter="saveSale"
            class="form-control text-center" value="{{$efectivo}}"
            >
            <div class="input-group-append">
                <span wire:click="$set('efectivo', 0)" class="input-group-text" style="background: #3B3F5C; color:white">
                    <i class="fas fa-backspace fa-2x"></i>
                </span>
            </div>
        </div>
        <h4 class="text-muted">Cambio: ${{number_format($change,2)}}</h4>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-12 col-md-12 col-lg-6">
            @if($total > 0)
                <button  onclick="Confirm('','clearCart','¿SEGURO DE ELIMINAR EL CARRITO?')"
                class="btn btn-dark mtmobile">
                CANCELAR F4
            </button>
            @endif
        </div>
        <br>
        <div class="col-sm-12 col-md-12 col-lg-6">
            @if($efectivo>= $total && $total > 0)
            <button wire:click.prevent="saveSale" class="btn btn-dark btn-md btn-block">GUARDAR F6</button>
            @endif
        </div>
    </div>

    <div class="col-sm-12 mt-1 text-center">
        <p class="text-muted">Reimprimir Última F7</p>
    </div>
    <div class="col-sm-12 mt-1 text-center">
        <button wire:click.prevent="creaXML()" class="btn btn-dark btn-block den">
            XML
        </button>
    </div>
</div>