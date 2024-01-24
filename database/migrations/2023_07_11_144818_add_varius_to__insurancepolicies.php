<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVariusToInsurancepolicies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('insurancepolicies', function (Blueprint $table) {
            //
            $table->integer('idcoverages'); 
            $table->integer('idinsurers'); 
            $table->text('comentario')->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('insurancepolicies', function (Blueprint $table) {
            //
            $table->integer('idcoverages'); 
            $table->integer('idinsurers'); 
            $table->text('comentario')->default(null);
        });
    }
}
