<?php

use App\Models\PatientInformation;
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
            $table->string('check_status')
                ->index('check_status')
                ->default(PatientInformation::CHECK_STATUS_NEED_CONFIRM)
                ->after('snils');
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
