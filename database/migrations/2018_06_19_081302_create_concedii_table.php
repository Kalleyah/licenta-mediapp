<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcediiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concediimedicales', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('pacient_id');
            $table->integer('consultid');
            $table->string('serie');
            $table->timestamp('startdate')->nullable();
            $table->timestamp('enddate')->nullable();
            $table->string('diagnostic');
            $table->string('duration');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concediimedicales');
    }
}
