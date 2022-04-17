<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Place;
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

    public function orderPlace($place) {
        $place = Place::findOrFail($place);
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
        ])->where('place_id', $place->id)->latest()->paginate(config('setting.LimitPaginate'));


        return view("dashboard.places.orders.index", compact('orders'));
    }// End OrderPlace
}
