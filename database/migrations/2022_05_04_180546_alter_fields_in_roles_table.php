<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFieldsInRolesTable extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('name', 50)->nullable(false)->change();
            $table->string('rights', 255)->nullable(false)->change();
        });
    }

    /**
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('name', 50)->nullable(true)->change();
            $table->string('rights', 255)->nullable(true)->change();
        });
    }
}
