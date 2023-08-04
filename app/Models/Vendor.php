<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $table = 'vendors';
    protected $guarded = [];
    public static array $status = ['active', 'inactive'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
