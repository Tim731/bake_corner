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
        Schema::create('delivery', function (Blueprint $table) {
            $table->id('delivery_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->enum('delivery_status', ['Pending', 'Out for Delivery', 'Delivered', 'Cancelled'])->default('Pending');
            $table->text('delivery_address');
            $table->date('delivery_date')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery');
    }
};
