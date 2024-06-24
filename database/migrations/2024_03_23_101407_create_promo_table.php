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
            $table->integer('code_promo')->unique();
            $table->string('type_promo')->unique();
            $table->string('info_promo');
            $table->decimal('harga_promo', 18, 2); // Decimal dengan 18 digit dan 2 desimal
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
