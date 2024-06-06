<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'order_date', 'order_details_ids'];

    protected $casts = [
        'order_details_ids' => 'array',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
