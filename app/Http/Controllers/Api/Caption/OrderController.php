<?php

namespace App\Http\Controllers\Api\Caption;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use GeneralTrait, LanguageTrait;
    public function ordersToday(Request $request) {
        $placeName =  $this->LanguageData('language', 'name' , 'placeName' ,$request);
        $ordersToday = Order::select(['place_id', 'caption_id', 'total_price'])
        ->withCount('captionOrders')
        ->where([
            ['caption_id', auth()->user()->id],
            ['status', 'Delivered']
        ])->whereDate('created_at', Carbon::today())
        ->with([
        'placeId' => function($q)  use($placeName){
            $q->select(['id','thumb' ,$placeName ]);
        }
        ])->latest()->paginate(config('setting.LimitPaginate'));

      if(!$ordersToday) {
          return $this->returnError('404','Sorry No Orders Found Try Make Sure Your Mode Online To Get Orders Today');
      }
      return $this->returnData('orders', $ordersToday);
    }// End Orders Today
}
