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
        Schema::create('perhitungan', function (Blueprint $table) {
            $table->id();
            $table->integer('demand')->default(0);
            $table->integer('max_demand')->default(0);
            $table->integer('safety_stock')->default(0);
            $table->integer('lead_time')->default(0);
            $table->integer('biaya_pesan')->default(0);
            $table->integer('biaya_penyimpanan')->default(0);
            $table->integer('EOQ')->default(0);
            $table->integer('ROP')->default(0);
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
        Schema::dropIfExists('perhitungan');
    }
};
