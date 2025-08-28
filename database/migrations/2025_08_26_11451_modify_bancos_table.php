<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bancos', function (Blueprint $table) {
            $table->string('cuenta_banco')
                  ->after('nombre')
                  ->comment('Categoría o tipo de banco');
        });
    }

    public function down(): void
    {
        Schema::table('bancos', function (Blueprint $table) {
            $table->dropColumn('cuenta_banco');
        });
    }
};
