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
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('impuesto', 10, 2)->unsigned()->change();
            $table->decimal('total', 10, 2)->unsigned()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('compras', function (Blueprint $table) {
            $table->decimal('impuesto', 8, 2)->unsigned()->change();
            $table->decimal('total', 8, 2)->unsigned()->change();
        });
    }
};
