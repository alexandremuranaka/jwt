<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('procedures', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->integer('hospital_id')->unsigned();
          $table->integer('tuss_id')->unsigned();
          $table->date('date');
          $table->string('member_id')->nullable();
          $table->string('medical_insurance')->nullable();
          $table->string('insurance_type')->nullable();
          $table->string('patient_name')->nullable();
          $table->string('register_number')->nullable();
          $table->string('procedured_number')->nullable();
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('tuss_id')->references('id')->on('tuss')->onDelete('cascade');
          $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedures');
    }
}
