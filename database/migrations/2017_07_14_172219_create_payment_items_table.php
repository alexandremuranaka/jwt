<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('payment_items', function (Blueprint $table) {
        $table->increments('id');
        $table->string('description');
        $table->string('tuss')->nullable();
        $table->string('insurer')->nullable();
        $table->decimal('value',10,2);
        $table->date('date');
        $table->integer('payment_id')->unsigned();
        $table->string('register');
        $table->integer('qtd');
        $table->datetime('conciliado_at')->nullable();
        $table->timestamps();

        $table->foreign('payment_id')
        ->references('id')->on('payments')
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
        Schema::dropIfExists('payment_items');
    }
}
