@include('common.modalHead')


                 {{-- CABECERA   --}}
                <div class="row">
                     <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label >Proveedor</label>
                            <div class="form-group">
                                <select wire:model.lazy="proveedor_id" class="form-control" required>
                                    <option value="Elegir" selected>Elegir</option>
                                    @foreach ($proveedores as $p )
                                    <option value="{{ $p->id }}" >{{ $p->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('proveedor_id') <span class="text-danger er">{{ $message}}</span>@enderror
                            </div>
                        </div>
                     </div>
                       <div class="mt-2 col-sm-6">
                            <div class="form-group">
                                <label>Tipo Identificador</label>
                                <select wire:model.lazy='tipoidentificador' class="form-control">
                                    <option value="Elegir" disabled>Elegir</option>
                                    <option value="factura" >Factura</option>
                                    <option value="nota de venta" >Nota de Venta</option>
                                    <option value="guia" >Guia</option>
                                    <option value="otrs" >otros</option>
                                </select>
                                @error('tipoidentificador') <span class="text-danger er">{{ $message}}</span>@enderror
                            </div>
                        </div>

                        <div class="mt-2 col-sm-6">

                            <div class="form-group">
                                <label >Valor Identificador</label>
                                <input type="text" wire:model.lazy="valoridentificador"
                                class="form-control" placeholder="001-002-003" autofocus >
                                @error('valoridentificador') <span class="text-danger er">{{ $message}}</span>@enderror
                            </div>
                        </div>

                </div>

                <br><br><br>


                {{-- TABLA PARA EL DETALLE   --}}

                <div class="row">

                    <div class="mt-2 col-sm-6">
                        <label for="">Producto</label>
                        <select wire:model.defer="producto_id" class="form-control" name="producto_id" id="producto_id">
                            <option value="Elegir" selected>Elegir</option>
                            @foreach ($productos as $p )
                            <option value="{{ $p->id }}" >{{ $p->nombre }}</option>
                            @endforeach
                        </select>
                        @error('producto_id') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="mt-2 col-sm-2">
                        <label >Cantidad</label>
                        <input type="number" wire:model.defer="cantidad"
                        class="form-control" autofocus name="cantidad" id="cantidad" >
                        @error('cantidad') <span class="text-danger er">{{ $message}}</span>@enderror
                    </div>

                    <div class="mt-2 col-sm-2">
                        <label >P. Compra</label>
                        <input type="number" wire:model.defer="preciocompra"
                        class="form-control" autofocus  name="preciocompra" id="preciocompra">

                    </div>

                    <br>
                    <div class="mt-2 col-sm-2">
                        <label >Agregar </label>
                        <button type="button" id="btn_add"  class="btn btn-primary">+</button>
                    </div>

                    {{-- TABLA DEL DETALLE  --}}
                    <div class="mt-2 col-sm-12">
                        <table id="detalles" class="table table-bordered table striped mt-1">
                            <thead class="text-white" style="background: #3B3F5C;">
                                <th class="table-th text-white text-center">Opciones</th>
                                <th class="table-th text-white text-center">Producto</th>
                                <th class="table-th text-white text-center">Cantidad</th>
                                <th class="table-th text-white text-center">P Compra</th>
                                <th class="table-th text-white text-center">SubTotal</th>
                            </thead>
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>TOTAL</th>
                                <th id="total">$ 0.00</th>
                            </tfoot>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>

                 {{-- FOOTER  --}}
                <div class="modal-footer" id="guardar">
                    <button type="button" wire:click.prevent="resetUI()" class="btn btn-dark close-btn text-info"
                        data-dismiss="modal">
                        CERRAR
                    </button>
                        <a href="javascript:void(0)"
                        onClick="Confirm()"
                        class="btn btn-dark ">
                        GUARDAR
                        </a>
                </div>




{{-- @include('common.modalFooter') --}}





