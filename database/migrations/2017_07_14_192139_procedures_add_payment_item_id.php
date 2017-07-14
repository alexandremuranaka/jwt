<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProceduresAddPaymentItemId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('procedures', function (Blueprint $table){
        $table->integer('payment_item_id')->unsigned()->nullable();
        $table->foreign('payment_item_id')
        ->references('id')->on('payment_items')
        ->onDelete('cascade');
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
