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
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->string('sales_order_no');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users');
            $table->integer('so_qty');
            $table->timestamp('order_date')->nullable();
            $table->decimal('total_amt',16,2);
            $table->string('detail_alamat');
            $table->string('message_so')->nullable();
            $table->string('metode_bayar');
            $table->timestamp('date_bayar')->nullable();
            $table->string('status_so');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
