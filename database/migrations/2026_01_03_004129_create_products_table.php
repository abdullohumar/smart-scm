<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kategori Produk (Opsional tapi disarankan)
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        // Tabel Master Produk
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();

            // Identitas Produk
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique(); // Stock Keeping Unit (Kode Unik Internal)
            $table->string('barcode')->nullable()->unique(); // Untuk scan Barcode/QR Scanner

            // Atribut Fisik (Penting untuk pengiriman/logistik)
            $table->string('unit')->default('pcs'); // pcs, box, kg

            // Smart Inventory Logic (Untuk ROP & Forecasting)
            $table->integer('minimum_stock')->default(0); // Batas aman (Safety Stock)
            $table->boolean('has_variants')->default(false); // Jika nanti ada warna/ukuran

            // Harga (Bisa dikembangkan jadi tabel harga terpisah jika ada tier pricing)
            $table->decimal('purchase_price', 15, 2)->default(0); // Harga Beli (HPP)
            $table->decimal('selling_price', 15, 2)->default(0);  // Harga Jual

            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
    }
};
