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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('pemesan')->nullable();
            $table->string('noTelp')->nullable();
            $table->timestamps();
            $table->timestamp('deadline')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat')->nullable();
            $table->string('sk')->nullable();
            $table->string('ket_tambahan')->nullable();
            $table->integer('persen_DP')->nullable();
            $table->integer('total_DP')->nullable();
            $table->integer('total_qty')->nullable();
            $table->integer('total_transaksi')->nullable();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
