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
            $table->boolean('itemMissing')->default(false);
            $table->boolean('wrongItem')->nullable();
            $table->string('nameOfCorrectedItem')->nullable();
            $table->boolean('wrongQuantity')->default(false);
            $table->string('quantityNeeded')->nullable();
            $table->boolean('damaged')->default(false);
            $table->string('typeOfDamage')->nullable();
            $table->decimal('damagedPhoto')->nullable();
            $table->string('comments')->nullable();
            $table->boolean('accepted')->default(false);
            $table->boolean('rejected')->default(false);
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
