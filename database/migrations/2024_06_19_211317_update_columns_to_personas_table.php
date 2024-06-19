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
        // Delete foreing key
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign(['documento_id']);
            $table->dropColumn('documento_id');
        });

        // Create a new foreign key
        Schema::table('personas', function (Blueprint $table) {
            $table->foreignId('documento_id')->after('estado')->constrained('documentos')->onDelete('cascade');
        });

        // Create new column
        Schema::table('personas', function (Blueprint $table) {
            $table->string('numero_documento', 20)->after('documento_id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Delete a new foreign key
        Schema::table('personas', function (Blueprint $table) {
            $table->dropForeign(['documento_id']);
            $table->dropColumn('documento_id');
        });

        // Create foreing key
        Schema::table('personas', function (Blueprint $table) {
            $table->foreignId('documento_id')->unique()->constrained('documentos')->onDelete('cascade');
        });

        // Create new column
        Schema::table('personas', function (Blueprint $table) {
            $table->dropColumn('numero_documento');
        });
    }
};
