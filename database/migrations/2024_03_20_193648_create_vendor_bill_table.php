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
        Schema::create('vendor_bill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leather_purchase_id');
            $table->foreign('leather_purchase_id')->references('id')->on('purchase_leather')->onDelete('cascade');
            $table->unsignedBigInteger('leather_vendor_id');
            $table->foreign('leather_vendor_id')->references('leather_vendor_id')->on('purchase_leather')->onDelete('cascade');
            $table->integer('remaining_balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_bill');
    }
};
