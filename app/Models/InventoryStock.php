<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryStock extends Model
{
    // Kita hanya mengizinkan manipulasi kolom ini
    protected $fillable = [
        'product_id',
        'bin_id',
        'quantity'
    ];

    // Relasi: Stok ini milik produk apa?
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi: Stok ini ada di kotak mana?
    // Dari sini kita bisa akses bin->rack->zone->warehouse
    public function bin(): BelongsTo
    {
        return $this->belongsTo(Bin::class);
    }
}
