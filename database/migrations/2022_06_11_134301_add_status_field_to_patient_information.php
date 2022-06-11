<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldToPatientInformation extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->string('check_status')->after('snils')->index('check_status');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('patient_information', function (Blueprint $table) {
            $table->dropIndex('check_status');
            $table->dropColumn('check_status');
        });
    }
}
