<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Place;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class CartController extends Controller
{
use GeneralTrait;
    public function store(Request $request) {

            $array = [
               'place'     => 1,
                'total'   => 2000,
                //Start Item
               'items' => [
                  [
                      'item_id' => 1,
                      'size'    => 2,
                      'place_id'    => 3,
                      'price'       => 100,
                      'quantity'    => 2,
                   'add_ons'    =>
                       [
                        [
                            'addon_id' => 1,
                            'quantity' => 3,
                            'price'  => 100,
                        ],
                           [
                               'addon_id' => 1,
                               'quantity' => 3,
                               'price'   => 100,
                           ],
                           [
                               'addon_id' => 1,
                               'quantity' => 3,
                               'price'   => 100,
                           ],
                           [
                               'addon_id' => 1,
                               'quantity' => 3,
                               'price'   => 100,
                           ],
                       ]
                  ],// End Item

                   [ //Start Item
                       'item_id' => 1,
                       'size'    => 2,
                       'place_id'    => 3,
                       'price'       => 100,
                       'quantity'    => 2,
                       'add_ons'    =>
                           [
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                           ]
                   ],// End Item


                   [ //Start Item
                       'item_id' => 1,
                       'size'    => 2,
                       'place_id'    => 3,
                       'price'       => 100,
                       'quantity'    => 2,
                       'add_ons'    =>
                           [
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                               [
                                   'addon_id' => 1,
                                   'quantity' => 3,
                                   'price'   => 100,
                               ],
                           ]
                   ],// End Item
               ],








            ];
        try{
            $collection = collect($array);


            $place = Place::find($collection['place']);

            $totalPrice = $collection['total'] + $place->tax + $place->fees + $place->delivers; // Total Price Of Order
            $order =  Order::create([
                'customer_id'       => auth()->user()->id,
                'place_id'          => $place->id,
                'status'            => 'Pending',
                'tax'               => $place->tax,
                'fees'              => $place->fees,
                'delivered_fees'    => $place->delivers,
                'total_price'       => $totalPrice,
            ]);// End Create Order

            foreach($collection['items'] as $item) {
                $items =  $order->items()->create([
                    'menu_id'       => $item['item_id'],
                    'size_id'       => $item['size'],
                    'customer_id'   => auth()->user()->id,
                    'place_id'      => $place->id,
                    'price'         => $item['price'],
                    'quantity'      => $item['quantity'],
                ]);//Create Items For Order

                if(!empty($item['add_ons']) && isset($item['add_ons'])) {

                    foreach($item['add_ons'] as $addOn) {
                        $items->AddOns()->create([
                            'customer_id'   => auth()->user()->id,
                            'addon_id'      => $addOn['addon_id'],
                            'quantity'      => $addOn['quantity'],
                            'price'         => $addOn['price'],
                        ]);
                    }// End AddOns Loop

                }// End If

            }// End Items Loop
            $order->notification()->create([
                'sender'        => auth()->user()->id,
                'receive'       => $place->id,
                'from'          => 'customer',
                'to'            => 'place',
                'place_id'      => $place->id,
                'message'       => 'اوردر جديد من العملاء',
                'readed'        => 0,
                'status'        => 1,
            ]);// End Create Notification


           return $this->returnSuccessMessage('Congratulations');
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }

    }// End Store
}
