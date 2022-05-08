<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_information', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('passport_series',4)->nullable();
            $table->char('passport_number',6)->nullable();
            $table->char('inn',13)->nullable();
            $table->char('snils',10)->nullable();
            $table->timestamps();
            $table->string('passport_path',255)->nullable();
            $table->string('analysis_path',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_information');
    }
}
