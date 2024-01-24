<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancepoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurancepolicies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('idusuario'); // usuario
            $table->integer('id_quote');// cotizacion
            $table->integer('idadmin');// quien aprobo
            $table->json('policies'); // json de la cotizacion
            $table->tinyInteger('estado')->default(0); // 0 creada pendiite, 1 anulada, 2 paga
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurancepolicies');
    }
}
