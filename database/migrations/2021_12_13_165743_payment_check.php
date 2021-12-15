<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PaymentCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentCheck', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('orderdetail_id');
            $table->foreign('orderdetail_id')->on('orderdetails')->references('id');
            $table->string('nama');
            $table->string('bankasal');
            $table->string('banktujuan');
            $table->string('image');
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
        Schema::dropIfExists('paymentCheck');
    }
}
