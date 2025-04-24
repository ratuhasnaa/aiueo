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
        // Membuat tabel room_images
        Schema::create('room_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); 
            $table->string('image'); 
            $table->boolean('is_primary')->default(false); // Untuk gambar utama
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });

        // Menghapus kolom image dari tabel rooms
        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'image')) {
                $table->dropColumn('image');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan kolom image ke tabel rooms
        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'image')) {
                $table->string('image')->nullable();
            }
        });

        // Menghapus tabel room_images
        Schema::dropIfExists('room_images');
    }
};
