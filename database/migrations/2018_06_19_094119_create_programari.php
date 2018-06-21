<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programaris', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacient_id');
            $table->string('numepacient')->nullable();
            $table->date('startdate')->nullable();
            $table->time('starthour')->nullable();
            $table->string('duration')->nullable();
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
        Schema::dropIfExists('programaris');
    }
}
