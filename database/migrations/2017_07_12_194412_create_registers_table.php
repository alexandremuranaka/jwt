<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      public function up()
          {
              Schema::create('registers', function (Blueprint $table) {
                  $table->increments('id');
                  $table->string('barcode');
                  $table->string('secondary_number');
                  $table->string('patient_name')->nullable();
                  $table->string('medical_insurance')->nullable();
                  $table->string('insurance_type')->nullable();
                  $table->boolean('favorite')->default(0);
                  $table->integer('user_id')->unsigned();
                  $table->integer('hospital_id')->unsigned();
                  $table->timestamps();

                  $table->foreign('user_id')
                  ->references('id')->on('accounts')
                  ->onDelete('cascade');

                  $table->foreign('hospital_id')
                  ->references('id')->on('hospitals')
                  ->onDelete('cascade');


              });
          }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registers');
    }
}
