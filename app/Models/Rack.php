<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rack extends Model
{
    protected $fillable = ['zone_id', 'name', 'code'];

    public function zone(): BelongsTo
    {
        return $this->belongsTo(Zone::class);
    }

    public function bins(): HasMany
    {
        return $this->hasMany(Bin::class);
    }
}
