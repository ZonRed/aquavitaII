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
        Schema::create('Promo', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_mulai_promo');
            $table->date('tanggal_akhir_promo');
            $table->integer('code_promo');
            $table->string('type_promo');
            $table->string('info_promo');
            $table->integer('harga_promo')->nullable();
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
        Schema::dropIfExists('Promo');
    }
};
