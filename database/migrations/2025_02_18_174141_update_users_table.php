<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Menambahkan kolom pada tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user', 'penyedia_konten', 'admin'])->default('user');
            $table->text('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan', 'tidak_diisi'])->default('tidak_diisi');
            $table->string('pekerjaan')->nullable();
        });

        // Membuat tabel ratings
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->integer('rating');
            $table->text('ulasan');
            $table->timestamps();
        });
    }

    public function down()
    {
        // Menghapus tabel ratings
        Schema::dropIfExists('ratings');

        // Menghapus kolom yang telah ditambahkan pada tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'alamat', 'no_hp', 'jenis_kelamin', 'pekerjaan']);
        });
    }
};
