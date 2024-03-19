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
        Schema::create('leather_colors', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->unsignedBigInteger('leather_id');
            $table->foreign('leather_id')->references('id')->on('leather')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leather_colors');
    }
};
