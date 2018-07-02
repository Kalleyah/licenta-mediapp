<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDoctorToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('concediimedicales', function($table)
        {
            $table->integer('medic')->nullable();
        });
        Schema::table('consults', function($table)
        {
            $table->integer('medic')->nullable();
        });
        Schema::table('programaris', function($table)
        {
            $table->integer('medic')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
