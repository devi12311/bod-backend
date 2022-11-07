<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('CLIENT_ID')->nullable();
            $table->integer('CLIENT_NUMBER')->nullable();
            $table->string('CLIENT_NAME')->nullable();
            $table->string('CLIENT_ADR_STREET_NAME')->nullable();
            $table->string('CLIENT_ADR_STREET_NR')->nullable();
            $table->integer('CLIENT_ADR_ZIPCODE')->nullable();
            $table->string('CLIENT_ADR_CITY')->nullable();
            $table->string('CLIENT_ADR_STATE')->nullable();
            $table->string('CLIENT_ADR_COUNTRY')->nullable();
            $table->string('CLIENT_PHONE')->nullable();
            $table->string('CLIENT_EMAIL')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
