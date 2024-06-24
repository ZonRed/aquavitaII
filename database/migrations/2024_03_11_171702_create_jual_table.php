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
            $table->integer('code_jual')->unique();
            $table->string('type_jual')->unique();
            $table->decimal('harga_jual', 18, 2); // Decimal dengan 18 digit dan 2 desimal
            $table->string('stock_jual');
            $table->integer('jumlah_jual');
            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users');
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
