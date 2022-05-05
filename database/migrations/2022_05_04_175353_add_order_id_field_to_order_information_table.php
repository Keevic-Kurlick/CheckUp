<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderIdFieldToOrderInformationTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::table('order_information', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable()
                ->references('id')
                ->on('orders');
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('order_information', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
        });

        Schema::table('order_information', function (Blueprint $table) {
            $table->dropColumn('order_id');
        });
    }
}
