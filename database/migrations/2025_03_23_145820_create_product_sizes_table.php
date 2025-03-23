<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_sizes', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->string('name');
            $table->decimal('additional_price', 8, 2)->default(0.00);

            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');

            $table->primary(['product_id', 'name']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_sizes');
    }
};
