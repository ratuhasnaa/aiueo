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
    Schema::create('venues_new', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('address');
        $table->string('city');
        $table->decimal('price', 10, 2);
        $table->integer('capacity');
        $table->string('category');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('venues_new');
}

};
