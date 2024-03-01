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
        Schema::create('parcela', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('venda_id');
            $table->decimal('valor', 10, 2);
            $table->date('data_vencimento');
            $table->timestamps();
            $table->foreign('venda_id')->references('id')->on('vendas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcela');
    }
};
