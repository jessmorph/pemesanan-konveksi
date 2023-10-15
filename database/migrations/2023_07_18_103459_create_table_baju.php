<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('baju', function (Blueprint $table) {
            $table->id();
            $table->string('bahan');
            $table->string('warna');
            $table->string('model');
            $table->string('name');
            $table->integer('xxs')->default(0);
            $table->integer('xs')->default(0);
            $table->integer('s')->default(0);
            $table->integer('m')->default(0);
            $table->integer('l')->default(0);
            $table->integer('xl')->default(0);
            $table->integer('xxl')->default(0);
            $table->integer('xxxl')->default(0);
            $table->integer('xxxxl')->default(0);
            $table->integer('totalBaju');
            $table->integer('hargaSatuan');
            $table->string('gambar')->nullable();
            $table->string('keterangan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baju');
    }
};
