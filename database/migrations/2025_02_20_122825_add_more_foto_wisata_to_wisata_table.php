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
        Schema::table('wisata', function (Blueprint $table) {
            $table->string('foto_wisata2')->nullable()->after('foto_wisata');
            $table->string('foto_wisata3')->nullable();
            $table->string('foto_wisata4')->nullable();
        });
    }

    public function down()
    {
        Schema::table('wisata', function (Blueprint $table) {
            $table->dropColumn(['foto_wisata2', 'foto_wisata3', 'foto_wisata4']);
        });
    }
};
