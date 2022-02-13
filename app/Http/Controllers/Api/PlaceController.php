<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Place;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
   use GeneralTrait, LanguageTrait;

   public function index($id, Request $request) {

       $name = $this->LanguageData('language', 'name' , 'placeName' ,$request);
       $places = Place::select(['id', $name, 'banner', 'thumb','phone','address','working_hours'])
           ->where([
               ['category_id', '=', $id],
               ['status', '=', 1]
           ])->latest()->paginate(config('setting.LimitPaginate'));

       return $this->returnData('places', $places);
   }// End Index
}
