<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Gudang (Headquarters/Cabang)
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: Gudang Pusat Jakarta
            $table->string('code')->unique(); // Contoh: WH-JKT-01
            $table->text('address')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes(); // Penting untuk Audit Trail (data tidak langsung hilang)
        });

        // 2. Tabel Zones (Area dalam gudang, misal: Area Elektronik, Area Makanan)
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Contoh: Zona A (Elektronik)
            $table->string('code'); // Contoh: Z-A
            $table->timestamps();
        });

        // 3. Tabel Racks (Lemari/Rak fisik dalam zona)
        Schema::create('racks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zone_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Contoh: Rak Besi 1
            $table->string('code'); // Contoh: R-01
            $table->timestamps();
        });

        // 4. Tabel Bins (Kotak spesifik dalam rak)
        Schema::create('bins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rack_id')->constrained()->cascadeOnDelete();
            $table->string('name'); // Contoh: Kotak 1, Tingkat 2
            $table->string('code'); // Contoh: B-02
            $table->integer('capacity')->default(0); // Opsional: Kapasitas maksimum item
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bins');
        Schema::dropIfExists('racks');
        Schema::dropIfExists('zones');
        Schema::dropIfExists('warehouses');
    }
};
