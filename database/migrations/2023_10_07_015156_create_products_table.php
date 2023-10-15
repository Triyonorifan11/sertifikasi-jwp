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
            // code product (unique)
            $table->string('product_code')->unique();
            // name
            $table->string('product_name');
            // image
            $table->string('product_image');
            // price
            $table->integer('product_price');
            // stock
            $table->integer('product_stock');
            // minimum stock (for notification)
            $table->integer('product_minimum_stock');
            // status
            $table->enum('product_status', ['active', 'inactive']);
            // description
            $table->text('product_description');
            // category
            $table->foreignId('category_id')->constrained('categories');
            // unit
            $table->foreignId('unit_id')->constrained('units');
            $table->timestamps();
            $table->softDeletes();
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
