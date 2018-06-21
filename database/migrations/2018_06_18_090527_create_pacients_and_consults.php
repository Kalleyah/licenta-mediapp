<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientsAndConsults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthdate');
            $table->string('cnp')->unique();
            $table->string('address');
            $table->string('phone');
            $table->timestamps();
        });
        Schema::create('consults', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pacient_id');
            $table->timestamp('consultdate')->useCurrent();
            $table->string('simpthoms');
            $table->string('diagnostics');
            $table->string('codboala');
            $table->string('threatment');
            $table->boolean('medicalbreak')->default(False);
            $table->integer('programid')->nullable();
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
        Schema::dropIfExists('pacients');
        Schema::dropIfExists('consults');
    }
}
