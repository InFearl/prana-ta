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
            $table->integer('demand');
            $table->integer('max_demand');
            $table->integer('safety_stock');
            $table->integer('lead_time');
            $table->integer('biaya_pesan');
            $table->integer('biaya_penyimpanan');
            $table->integer('EOQ');
            $table->integer('ROP');
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
