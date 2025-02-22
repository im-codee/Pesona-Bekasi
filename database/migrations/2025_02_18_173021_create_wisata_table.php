<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel wisata
        Schema::create('wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wisata');
            $table->string('desa');
            $table->string('kecamatan');
            $table->text('alamat');
            $table->enum('kategori_wisata', ['waterpark', 'mall', 'wisata_alam', 'wisata_kuliner', 'danau', 'pantai', 'tempat_bersejarah', 'sport', 'lainnya']);
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('no_telp')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Tabel type_wisata
        Schema::create('type_wisata', function (Blueprint $table) {
            $table->id();
            $table->string('nama_type');
            $table->timestamps();
        });

        // Tabel pivot wisata_type_wisata
        Schema::create('wisata_type_wisata', function (Blueprint $table) {
            $table->foreignId('wisata_id')->constrained('wisata')->onDelete('cascade');
            $table->foreignId('type_wisata_id')->constrained('type_wisata')->onDelete('cascade');
            $table->primary(['wisata_id', 'type_wisata_id']);
        });

        // Tabel location
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address');
            $table->string('os');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('cookie');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('location');
        Schema::dropIfExists('wisata_type_wisata');
        Schema::dropIfExists('type_wisata');
        Schema::dropIfExists('wisata');
    }
};
