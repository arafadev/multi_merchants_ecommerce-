<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function scopeFeaturedProducts($query)
    {
        return $query->where([
            ['featured', 1],
            ['status', 1]
        ])
            ->orderBy('id', 'desc')
            ->limit(6);
    }

    public function multiImages()
    {
        return $this->hasMany(MultiImg::class);
    }
}
