<?php

// database/migrations/xxxx_xx_xx_remove_price_from_rooms_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemovePriceFromRoomsTable extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn('price'); // Hapus kolom price dari rooms
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('price')->nullable(); // Tambahkan kembali jika rollback
        });
    }
}
