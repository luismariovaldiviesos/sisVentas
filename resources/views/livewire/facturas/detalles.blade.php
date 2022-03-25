<div class="connect-sorting-content">
	<div class="card simple-title-task ui-sortable-handle">
		<div class="card-body">

		{{-- @if($total > 0) --}}
            <div class="table-responsive tblscroll" style="max-height: 650px; overflow: hidden">
                <table class="table table-bordered table-striped mt-1">
                    <thead class="text-white" style="background: #3B3F5C">
                        <tr>
                            <th width="10%"></th>
                            <th class="table-th text-left text-white">Código Pr.</th>
                            <th width="13%" class="table-th text-center text-white">Cant.</th>
                            <th class="table-th text-center text-white">Descripción</th>
                            <th class="table-th text-center text-white">Precio Uni</th>
                            <th class="table-th text-center text-white">Dscto</th>
                            <th class="table-th text-center text-white">precio Total</th>
                        </tr>
                    </thead>

                </table>
            </div>
		{{-- @else --}}
		    <h5 class="text-center text-muted">Agrega productos a la venta</h5>
		{{-- @endif --}}

<!--
		<div wire:loading.inline wire:target="saveSale">
			<h4 class="text-danger text-center">Guardando Venta...</h4>
		</div>
	-->



		</div>
	</div>
</div>
