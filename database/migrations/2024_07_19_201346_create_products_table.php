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
            $table->string('product_code')->unique();
            $table->string('name');
            $table->string('image')->nullable();
            $table->decimal('price',10,2);
            $table->decimal('sale_price',10,2)->nullable();
            $table->string('short_description')->nullable();
            $table->text('content')->nullable();
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('view')->default(0);
            $table->date('date_add');
            $table->foreignId('category_id')->constrained();
            $table->boolean('status')->default(true);
            $table->boolean('is_new')->default(true);
            $table->boolean('is_hot')->default(true);
            $table->boolean('is_sale')->default(true);
            $table->boolean('is_show_home')->default(true);
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
