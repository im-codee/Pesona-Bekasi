<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('location', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('lokasi'); // Menambahkan user_id
            $table->string('browser')->after('os'); // Menambahkan browser
        });
    }

    public function down()
    {
        Schema::table('location', function (Blueprint $table) {
            $table->dropColumn(['user_id', 'browser']); // Menghapus jika rollback
        });
    }
};
