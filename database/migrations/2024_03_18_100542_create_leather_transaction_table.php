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
        Schema::create('leather_transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_leather_id');
            $table->foreign('purchase_leather_id')->references('id')->on('purchase_leather')->onDelete('cascade');
            $table->string("transaction_date");
            $table->enum('transaction_type', ['purchase', 'payment', 'return']);
            $table->integer("amount");
            $table->string("description")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leather_transaction');
    }
};
