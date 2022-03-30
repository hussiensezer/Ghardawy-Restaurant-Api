<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartStoreRequest;
use App\Models\Addon;
use App\Models\Menu;
use App\Models\MenuPriceSize;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Place;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    use GeneralTrait;

    public function checkout(Request $request)
    {

//            $array = [
//                'order'=> [
//               'place'     => 1,
//                'total'   => 2000,
//
//               'items' => [
//                  [
//                      'item_id' => 1,
//                      'size'    => 2,
//                      'place_id'    => 3,
//                      'price'       => 100,
//                      'quantity'    => 2,
//                   'add_ons'    =>
//                       [
//                        [
//                            'addon_id' => 1,
//                            'quantity' => 3,
//                            'price'  => 100,
//                        ],
//                           [
//                               'addon_id' => 1,
//                               'quantity' => 3,
//                               'price'   => 100,
//                           ],
//                           [
//                               'addon_id' => 1,
//                               'quantity' => 3,
//                               'price'   => 100,
//                           ],
//                           [
//                               'addon_id' => 1,
//                               'quantity' => 3,
//                               'price'   => 100,
//                           ],
//                       ]
//                  ],
//
//                   [
//                       'item_id' => 1,
//                       'size'    => 2,
//                       'place_id'    => 3,
//                       'price'       => 100,
//                       'quantity'    => 2,
//                       'add_ons'    =>
//                           [
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                           ]
//                   ],
//
//
//                   [
//                       'item_id' => 1,
//                       'size'    => 2,
//                       'place_id'    => 3,
//                       'price'       => 100,
//                       'quantity'    => 2,
//                       'add_ons'    =>
//                           [
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                               [
//                                   'addon_id' => 1,
//                                   'quantity' => 3,
//                                   'price'   => 100,
//                               ],
//                           ]
//                   ],
//               ],
//            ],
//            ];
//
//        return $request->order['total'];
        try {
            $rule = [
                'order.place' => ['required', Rule::exists('places', 'id')],
                'order.items.*.item_id' => ['required',Rule::exists('menus', 'id')->where(function($q) use($request){
                    $q->where('status', 1);
                    $q->where('place_id', $request->order['place']);
                })],
                'order.items.*.size'                    => ['required', Rule::exists('menu_price_sizes', 'id')],
                'order.items.*.place_id'                => ['required', 'same:order.place'],
                'order.items.*.quantity'                => ['required', 'integer', 'gt:0'],
                'order.items.*.add_ons.*.addon_id'      => ['sometimes','nullable', Rule::exists('addons' , 'id')],
                'order.items.*.add_ons.*.quantity'      => ['sometimes','nullable', 'integer', 'gt:0'],
            ];
            $validator = Validator::make($request->all(), $rule);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }











            $place = Place::find($request->order['place']);

            $totalPrice = $request->order['total'] + $place->tax + $place->fees + $place->delivers; // Total Price Of Order
            $order = Order::create([
                'customer_id' => auth()->user()->id,
                'place_id' => $place->id,
                'status' => 'Pending',
                'tax' => $place->tax,
                'fees' => $place->fees,
                'delivered_fees' => $place->delivers,
                'total_price' => $totalPrice,
            ]);// End Create Order
//
            foreach ($request->order['items'] as $item) {
                $items = $order->items()->create([
                    'menu_id' => $item['item_id'],
                    'size_id' => $item['size'],
                    'customer_id' => auth()->user()->id,
                    'place_id' => $place->id,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                ]);//Create Items For Order

                if (!empty($item['add_ons']) && isset($item['add_ons'])) {

                    foreach ($item['add_ons'] as $addOn) {
                        $items->AddOns()->create([
                            'customer_id' => auth()->user()->id,
                            'addon_id' => $addOn['addon_id'],
                            'quantity' => $addOn['quantity'],
                            'price' => $addOn['price'],
                        ]);
                    }// End AddOns Loop

                }// End If

            }// End Items Loop
            $order->notification()->create([
                'sender' => auth()->user()->id,
                'receive' => $place->id,
                'from' => 'customer',
                'to' => 'place',
                'place_id' => $place->id,
                'message' => 'اوردر جديد من العملاء',
                'readed' => 0,
                'status' => 1,
            ]);// End Create Notification


            return $this->returnSuccessMessage('Congratulations');
        } catch (Exception $e) {
            return $this->returnError('', $e->getMessage());
        }

    }// End Store


}
