<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('direccion');
            $table->string('colonia');
            $table->string('latitud');
            $table->string('longitud');
            $table->string('telefono');
            $table->string('img');
            $table->text('descripcion');
            $table->time('apertura');
            $table->time('cierre');
            $table->uuid('uuid');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('categoria_id')->constrained();
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
        Schema::dropIfExists('establecimientos');
    }
}
