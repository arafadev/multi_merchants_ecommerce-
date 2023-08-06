<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

  /**
   * Get the division that owns the Order
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function division(): BelongsTo
  {
      return $this->belongsTo(ShipDivision::class);
  }

  /**
   * Get the division that owns the Order
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function district(): BelongsTo
  {
      return $this->belongsTo(ShipDistricts::class);
  }

  /**
   * Get the state that owns the Order
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function state(): BelongsTo
  {
      return $this->belongsTo(ShipState::class);
  }

  /**
   * Get the user that owns the Order
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function user(): BelongsTo
  {
      return $this->belongsTo(User::class);
  }
}
