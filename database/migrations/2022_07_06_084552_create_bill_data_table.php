<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained();
            $table->integer('BOD_DELIVER_ITEM_NR');
            $table->string('BOD_ITEM_DESCRIPTION');
            $table->integer('BOD_ORDER_AMOUNT');
            $table->string('BOD_ORDER_UNIT');
            $table->decimal('PRICE');
            $table->integer('BOD_Deliver_AMOUNT');
            $table->string('BOD_DELIVER_UNIT');
            $table->string('itemMissing')->nullable();
            $table->string('wrongItem')->nullable();
            $table->decimal('nameOfCorrectedItem')->nullable();
            $table->integer('wrongQuantity')->nullable();
            $table->string('quantityNeeded')->nullable();
            $table->string('damaged')->nullable();
            $table->string('typeOfDamage')->nullable();
            $table->decimal('damagedPhoto')->nullable();
            $table->integer('comments')->nullable();
            $table->string('accepted')->nullable();
            $table->string('rejected')->nullable();
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
        Schema::dropIfExists('bill_data');
    }
}
