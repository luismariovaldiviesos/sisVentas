<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('user_id');
            $table->string('codDoc',2); // ma´ximo dos en tamaño
            $table->string('claveAcceso',49); // maximo 49 en tamaño
            $table->string('secuencial',9); // ma´ximo 9 en tamaño
            // $table->dateTime('fechaEmision');  created_at
            $table->enum('estado',['PAGADA','PENDIENTE','ELIMINADA'])->default('PAGADA');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('facturas');
    }
}
