<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('passport_series',4)->nullable();
            $table->char('passport_number',6)->nullable();
            $table->char('inn',13)->nullable();
            $table->char('snils',10)->nullable();
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
        Schema::dropIfExists('patient_information');
    }
}
