<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descripcion');
            $table->string('clase');
            $table->string('equipo');
            $table->string('estado');
            $table->string('comentario')->default("")->nullable();
            $table->unsignedBigInteger('id_profesor');
            $table->boolean('activo')->default(true);
            $table->timestamps();
            /*create relation w/professor*/
            $table->foreign('id_profesor')->references('id')->on('professors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}
