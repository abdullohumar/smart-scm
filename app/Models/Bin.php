<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bin extends Model
{
    protected $fillable = ['rack_id', 'name', 'code', 'capacity'];

    public function rack(): BelongsTo
    {
        return $this->belongsTo(Rack::class);
    }

    // Relasi ke Stok: Satu Bin bisa berisi banyak jenis barang
    public function stocks(): HasMany
    {
        return $this->hasMany(InventoryStock::class);
    }
}
