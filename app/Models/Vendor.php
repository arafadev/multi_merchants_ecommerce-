<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    use Notifiable;

    protected $table = 'vendors';
    protected $guarded = [];
}
