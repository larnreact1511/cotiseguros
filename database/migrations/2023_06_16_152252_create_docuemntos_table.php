<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocuemntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docuemntos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('documentonombre');
            $table->string('tipodocumento');
            $table->string('url');
            $table->integer('idusuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('docuemntos');
    }
}
