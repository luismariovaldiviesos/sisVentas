<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->decimal('precioUnitario');
            $table->decimal('descuento');
            $table->decimal('precioTotalSinImpuesto');
            $table->string('formaPago'); //01 efectivo
            $table->decimal('subtotal12');
            $table->decimal('subtotal0');
            $table->decimal('iva12');
            $table->decimal('total');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_facturas');
    }
}
