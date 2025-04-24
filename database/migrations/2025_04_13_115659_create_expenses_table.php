<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('description');
            $table->date('date');
            $table->integer('item_total');
            $table->decimal('amount', 15, 2); // untuk menyimpan angka besar dengan 2 digit desimal
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('expenses');
    }
};

