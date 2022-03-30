<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index() {
        $orders =  Order::with([
            'placeId' => function($q) {
                $q->select(['id', 'name', 'longitude', 'latitude']);
            },
            'customerId' => function($q) {
                $q->select(['id','name', 'phone', 'longitude', 'latitude', 'address']);
            },
            'captionId' => function($q) {
                $q->select(['id', 'name', 'phone', 'longitude', 'latitude']);
            },
            'items.menuId' =>  function($q) {
                $q->select(['id', 'name']);
            },
            'items.sizeId' =>  function($q) {
                $q->select(['id', 'name']);
            },
            'items.AddOns',
            'items.AddOns.addonId'
        ])->latest()->paginate(config('setting.LimitPaginate'));

//        return $orders;
        return view("dashboard.orders.index",compact('orders'));
    }// End Index
}
