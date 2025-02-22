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
        Schema::table('location', function (Blueprint $table) {
            $table->string('lokasi')->nullable()->after('longitude'); // Menambahkan kolom lokasi setelah longitude
        });
    }

    public function down(): void
    {
        Schema::table('location', function (Blueprint $table) {
            $table->dropColumn('lokasi');
        });
    }
};
