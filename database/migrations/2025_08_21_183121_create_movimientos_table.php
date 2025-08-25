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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_movimiento', ['ingreso', 'egreso', 'transferencia']);
            $table->decimal('monto', 20, 2);
            $table->foreignId('banco_emisor_id')->nullable()->contrained('bancos', 'id')->onDelete('cascade');
            $table->foreignId('banco_receptor_id')->nullable()->constrained('bancos', 'id')->onDelete('cascade');
            $table->dateTime('fecha');
            $table->string('motivo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};
