<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVarius2ToInsurancepolicies extends Migration
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
            $table->tinyInteger('tipopoliza')->default(1); // 1 salud, 2 autos, 3 empresa
            $table->text('descripcionpoliza')->default('');// nombre de emresa, placa, modelo etect
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('_insurancepolicies', function (Blueprint $table) {
            //
        });
    }
}
