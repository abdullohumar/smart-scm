<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'barcode',
        'unit',
        'minimum_stock',
        'has_variants',
        'purchase_price',
        'selling_price',
        'description',
        'image',
        'is_active'
    ];

    // Logic Otomatisasi SKU, Slug, dan Barcode
    protected static function booted()
    {
        static::creating(function ($product) {
            // 1. Auto-generate Slug
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }

            // 2. Auto-generate SKU jika kosong
            if (empty($product->sku)) {
                $product->sku = 'PRD-' . date('Y') . '-' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            }

            // 3. Auto-generate Barcode String jika kosong (Fitur Baru)
            // Kita samakan dengan SKU agar konsisten, atau bisa format lain
            if (empty($product->barcode)) {
                $product->barcode = $product->sku;
            }
        });
    }

    // Relasi: Satu produk bisa ada di banyak Bin (melalui tabel InventoryStock)
    public function inventoryStocks(): HasMany
    {
        return $this->hasMany(InventoryStock::class);
    }
}
