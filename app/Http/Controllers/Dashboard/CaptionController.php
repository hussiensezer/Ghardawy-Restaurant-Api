<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaptionStoreRequest;
use App\Http\Requests\CaptionUpdateRequest;
use App\Models\Caption;
use App\Models\Order;
use App\Models\Place;
use Illuminate\Http\Request;

class CaptionController extends Controller
{

    public function index() {
        $captions = Caption::latest()->paginate(config('setting.LimitPaginate'));

      return view('dashboard.captions.index', compact('captions'));
    }// End Index

    public function create() {
        return view('dashboard.captions.create');
    }// End Create

    public function store(CaptionStoreRequest $request) {

        try {
            $caption = Caption::create([
                'name'  => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'online'=> $request->online,
                'have_order'    => 0,
                'password'  => bcrypt($request->password),
                'admin_id'  => auth()->user()->id,
                'status'    => $request->status,
            ]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store

    public function update(CaptionUpdateRequest $request, $id) {
        try {
            $caption = Caption::findOrFail($id);

            $caption->update([
                'name'  => $request->name,
                'email' => $request->email,
                'password'  => !empty($request->password )? bcrypt($request->password) : $caption->password,
                'status'    => $request->status,
                'online'    => $request->online
            ]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update


    public function captionOrders($caption)
    {
        $caption = Caption::findOrFail($caption);
        $orders = Order::with([
            'placeId' => function ($q) {
                $q->select(['id', 'name', 'longitude', 'latitude']);
            },
            'customerId' => function ($q) {
                $q->select(['id', 'name', 'phone', 'longitude', 'latitude', 'address']);
            },
            'captionId' => function ($q) {
                $q->select(['id', 'name', 'phone', 'longitude', 'latitude']);
            },
            'items.menuId' => function ($q) {
                $q->select(['id', 'name']);
            },
            'items.sizeId' => function ($q) {
                $q->select(['id', 'name']);
            },
            'items.AddOns',
            'items.AddOns.addonId'
        ])->where('caption_id', $caption->id)->latest()->paginate(config('setting.LimitPaginate'));


        return view("dashboard.places.orders.index", compact('orders'));
    }// End Caption Orders
}
