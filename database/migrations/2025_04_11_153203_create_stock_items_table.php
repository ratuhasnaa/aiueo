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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->id(); // Kolom ID auto increment
            $table->string('product_name'); // Nama produk
            $table->integer('quantity'); // Jumlah stok
            $table->bigInteger('price'); // Harga (dalam rupiah)
            $table->enum('status', ['Available', 'Low', 'Out of Stock']); // Status stok
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
