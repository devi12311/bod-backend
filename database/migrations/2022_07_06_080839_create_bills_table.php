<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained();
            $table->string('RECEIVER')->nullable();
            $table->string('TRUCK_DRIVER')->nullable();
            $table->string('PRINTED_AT')->nullable();
            $table->integer('BOD_ORDER_NUMBER_ERP')->nullable();
            $table->integer('BOD_WEBSHOP_ORDER_ID')->nullable();
            $table->date('BOD_ORDER_DATE')->nullable();
            $table->integer('BOD_NR_Bill_OF_DELIVERY')->nullable();
            $table->date('BOD_Delivery_Date')->nullable();
            $table->integer('BOD_DELIVERY_TOUR')->nullable();
            $table->text('BOD_DELIVERY_INSTRUCTION')->nullable();
            $table->decimal('DISCOUNT')->nullable();
            $table->decimal('DISCOUNT_INCLUDED')->nullable();
            $table->decimal('TOTAL_WITHOUT_VAT')->nullable();
            $table->decimal('TOTAL_WITH_VAT')->nullable();
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
        Schema::dropIfExists('bills');
    }
}
