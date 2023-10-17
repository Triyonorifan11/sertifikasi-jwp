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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name')->unique();
            $table->string('role_description')->nullable();
            $table->boolean('master_product')->default(false);
            $table->boolean('master_user')->default(false);
            $table->boolean('master_role')->default(false);
            // $table->boolean('master_customer')->default(false);
            // $table->boolean('master_supplier')->default(false);
            $table->boolean('master_unit')->default(false);
            $table->boolean('master_category')->default(false);
            $table->boolean('sales_order')->default(false); // penjualan barang
            $table->boolean('purchase_order')->default(false); //untuk pengadaan barang
            $table->boolean('keranjang')->default(false); //untuk pengadaan barang
            $table->boolean('delivery_status')->default(false); //untuk status pembelian

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
