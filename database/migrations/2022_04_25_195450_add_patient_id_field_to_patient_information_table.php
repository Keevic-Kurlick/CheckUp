<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPatientIdFieldToPatientInformationTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->foreignId('patient_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });

        Schema::table('patient_information', function (Blueprint $table) {
            $table->dropColumn('patient_id');
        });
    }
}
