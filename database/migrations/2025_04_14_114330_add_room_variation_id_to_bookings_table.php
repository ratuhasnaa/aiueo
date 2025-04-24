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
        Schema::table('bookings', function (Blueprint $table) {
            $table->unsignedBigInteger('room_variation_id')->nullable()->after('room_id');
            $table->foreign('room_variation_id')->references('id')->on('room_variations')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['room_variation_id']);
            $table->dropColumn('room_variation_id');
        });
    }
    
};
