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
        Schema::create('purchase_leather_color', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_leather_id');
            $table->foreign('purchase_leather_id')->references('id')->on('purchase_leather')->onDelete('cascade');
            $table->unsignedBigInteger('leather_color_id');
            $table->foreign('leather_color_id')->references('id')->on('leather_colors')->onDelete('cascade');
            $table->integer("cost_per_unit");
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_leather_color');
    }
};
