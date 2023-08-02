<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShipDistricts extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the division that owns the ShipDistricts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(ShipDivision::class);
    }
}
