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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['Tire', 'Rim']);
            $table->enum('state', ['Brand New', 'Secondhand']);
            $table->string('brand');
            $table->string('material')->default('N/A');
            $table->string('size');
            $table->string('image_path');
            $table->unsignedSmallInteger('stocks')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
