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
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('callmeaf-product.model'))->constrained()->cascadeOnDelete();
            $table->foreignIdFor(config('callmeaf-variation-type.model'))->nullable()->constrained()->nullOnDelete();
            $table->string('status')->nullable();
            $table->string('nature')->nullable();
            $table->string('sku')->nullable();
            $table->string('price')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('stock')->nullable();
            $table->string('title')->nullable();
            $table->string('content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variations');
    }
};
