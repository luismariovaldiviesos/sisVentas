<div wire:ignore.self class="modal fade" id="detallesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-dark">
          <h5 class="modal-title text-white">
                <b>Detalle de Ingreso</b>
            </h5>
          <h6 class="text-center text-warning" wire:loading>POR FAVOR ESPERE</h6>
        </div>
        <div class="modal-body">

          <div class="table-responsive">
            <table class="table table-bordered table striped mt-1">
              <thead class="text-white" style="background: #3B3F5C">
                <tr>
                    <th class="table-th text-white text-center">ID</th>
                  <th class="table-th text-white text-center">PRODUCTO</th>
                  <th class="table-th text-white text-center">CANT</th>
                  <th class="table-th text-white text-center">PRECIO COMPRA</th>
                  <th class="table-th text-white text-center">SUBTOTAL</th>


                </tr>
              </thead>
              <tbody>
                @foreach($detalles as $d)
                <tr>
                    <td class='text-center'><h6>{{$d->id}}</h6></td>
                  <td class='text-center'><h6>{{$d->productonombre}}</h6></td>
                  <td class='text-center'><h6>{{$d->cantidad}}</h6></td>
                  <td class='text-center'><h6>${{$d->preciocompra}}</h6></td>
                  <td class='text-center'><h6>${{$d->cantidad * $d->preciocompra}}</h6></td>


                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>

                </tr>
              </tfoot>
            </table>
          </div>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-dark close-btn text-info" data-dismiss="modal">CERRAR</button>
        </div>
      </div>
    </div>
  </div>
