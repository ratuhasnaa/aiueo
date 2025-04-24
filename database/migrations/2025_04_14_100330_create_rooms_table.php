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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('rent', 10, 2);
            $table->string('short_code');
            $table->integer('number_of_rooms');
            $table->string('room_type');
            $table->string('status');
            $table->timestamps();
        });
    }
    
};
