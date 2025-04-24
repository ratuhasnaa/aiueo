<?php

// database/migrations/xxxx_xx_xx_create_room_variations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomVariationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('room_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('room_id'); // Foreign Key ke tabel rooms
            $table->string('name'); // Nama variasi (contoh: "Jacaranda 1")
            $table->integer('capacity_u_shape')->nullable();
            $table->integer('capacity_double_u_shape')->nullable();
            $table->integer('capacity_theatre')->nullable();
            $table->integer('capacity_classroom')->nullable();
            $table->integer('capacity_round_table')->nullable();
            $table->integer('capacity_cocktail')->nullable();
            $table->integer('size')->nullable(); // Ukuran kamar
            $table->integer('price_per_hour'); // Harga per jam
            $table->timestamps();
            
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('room_variations');
    }
}