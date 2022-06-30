<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_voucher', function (Blueprint $table) {
            $table->increments('voucher_id');
            $table->string('voucher_name');
            $table->string('voucher_code');
            $table->string('voucher_amount');
            $table->string('voucher_condition');
            $table->string('voucher_percent_discount');
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
        Schema::dropIfExists('tbl_voucher');
    }
};
