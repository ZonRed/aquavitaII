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
        Schema::create('Jual', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_jual');
            $table->integer('code_jual');
            $table->string('type_jual');
            $table->integer('harga_jual');
            $table->string('stock_jual');
            $table->integer('jumlah_jual')->nullable();
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
        Schema::dropIfExists('Jual');
    }
};
