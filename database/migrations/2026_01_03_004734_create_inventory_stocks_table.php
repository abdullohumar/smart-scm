<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_stocks', function (Blueprint $table) {
            $table->id();

            // Relasi ke Produk
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();

            // Relasi ke Lokasi Spesifik (Bin/Kotak)
            // Dari Bin, kita bisa tahu Rak, Zona, dan Gudangnya.
            $table->foreignId('bin_id')->constrained()->cascadeOnDelete();

            // Jumlah barang di kotak spesifik ini
            $table->integer('quantity')->default(0);

            $table->timestamps();

            // Best Practice: Mencegah duplikasi data.
            // Satu jenis produk hanya boleh punya satu record di satu bin yang sama.
            // Jika tambah barang, kita update quantity-nya, bukan buat baris baru.
            $table->unique(['product_id', 'bin_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_stocks');
    }
};
