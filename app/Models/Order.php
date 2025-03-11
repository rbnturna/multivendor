<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Order extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'user_id',
        'portal_id',
        'handler_id',
        'status',
        'total_price',
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'additional_phone',
        'address1',
        'address2',
        'country',
        'city',
        'state',
        'zip',
        'shipping_first_name',
        'shipping_last_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address1',
        'shipping_address2',
        'shipping_country',
        'shipping_city',
        'shipping_state',
        'shipping_zip',
        'payment_method',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'created_by',
        'order_type',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

