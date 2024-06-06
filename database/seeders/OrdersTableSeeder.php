<?php

namespace Database\Seeders;

use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        Order::factory()->count(10000)->create()->each(function ($order) {
            $orderDetails = OrderDetail::factory()->count(5)->create(['order_id' => $order->id]);
            $orderDetailIds = $orderDetails->pluck('id')->toArray();
            $order->update(['order_details_ids' => $orderDetailIds]);
        });
    }
}
