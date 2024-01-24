<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdInsurancepoliciesToFrequencyofpayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('frequencyofpayments', function (Blueprint $table) {
            //
            $table->integer('id_insurancepolicies'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frequencyofpayments', function (Blueprint $table) {
            //
        });
    }
}
