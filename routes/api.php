<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{order}', [OrderController::class, 'show']);
Route::get('orders/{order}/ids', [OrderController::class, 'getOrderDetailsByIds']);
Route::get('orders/{order}/relation', [OrderController::class, 'getOrderDetailsByRelation']);
