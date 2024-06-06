<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
//    public function index()
//    {
//        $orders = Order::with('orderDetails')->paginate(10);
//        return response()->json($orders);
//    }
//
//    public function getOrderDetailsByIds(Order $order)
//    {
//        $orderDetailIds = $order->order_details_ids;
//
//        if (!is_array($orderDetailIds)) {
//            $orderDetailIds = json_decode($orderDetailIds, true);
//        }
//
//        $orderDetails = OrderDetail::whereIn('id', $orderDetailIds)->get();
//
//        return response()->json($orderDetails);
//    }
//
//    public function getOrderDetailsByRelation(Order $order)
//    {
//        return response()->json($order->orderDetails);
//    }
//
//    public function show(Order $order)
//    {
//        return response()->json($order->load('orderDetails'));
//    }

    ////////////////////////////////////////////////////////////////////
    public function index()
    {
        $orders = DB::table('orders')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->select('orders.*', 'order_details.*')
            ->paginate(20);

        return response()->json($orders);
    }

    public function getOrderDetailsByIds($id)
    {
        $order = DB::table('orders')->find($id);

        $orderDetailIds = json_decode($order->order_details_ids, true);

        if (!is_array($orderDetailIds)) {
            return response()->json(['message' => 'Invalid order details IDs.'], 400);
        }

        $orderDetails = DB::table('order_details')
            ->whereIn('id', $orderDetailIds)
            ->get();

        return response()->json($orderDetails);
    }

    public function getOrderDetailsByRelation($id)
    {
        $order = DB::table('orders')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.id', $id)
            ->select('orders.*', 'order_details.*')
            ->first();

        $orderDetails = DB::table('order_details')
            ->where('order_id', $id)
            ->get();

        return response()->json($orderDetails);
    }

    public function show($id)
    {
        $order = DB::table('orders')
            ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
            ->where('orders.id', $id)
            ->select('orders.*', 'order_details.*')
            ->first();

        return response()->json($order);
    }

}
