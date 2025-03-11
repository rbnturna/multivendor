<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    //
    protected $fillable = ['code', 'discount_amount', 'discount_percentage'];

    public function discount($subtotal)
    {
        if ($this->discount_amount) {
            return $this->discount_amount;
        }

        if ($this->discount_percentage) {
            return ($this->discount_percentage / 100) * $subtotal;
        }

        return 0;
    }
}
