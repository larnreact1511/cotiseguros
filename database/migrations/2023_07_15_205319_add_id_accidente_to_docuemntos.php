<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAccidenteToDocuemntos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('docuemntos', function (Blueprint $table) {
            //
            $table->integer('id_accidente')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('docuemntos', function (Blueprint $table) {
            //
            $table->integer('id_accidente')->default(0);
        });
    }
}
