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
        Schema::create('leather_inventory', function (Blueprint $table) {
            $table->id();
            $table->string('lot_no');
            $table->unsignedBigInteger('leathercolor_id');
            $table->foreign('leathercolor_id')->references('id')->on('leather_colors')->onDelete('cascade');
            $table->integer('quantity_on_hand');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leather_inventory');
    }
};
