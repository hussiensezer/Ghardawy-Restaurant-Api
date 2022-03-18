<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MenuCategory;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;

class MenuCategoryController extends Controller
{


   use GeneralTrait, LanguageTrait;

   public function index(Request $request,$id) {

       $name = $this->LanguageData('language', 'name' , 'categoryMenuName' ,$request);
       $categoriesMenu = MenuCategory::select(['id',$name, 'image'])
           ->where([
               ['status', 1],
               ['place_id', $id]
           ])
           ->orderBy('sort', 'asc')
           ->paginate(config('setting.LimitPaginate'));
       return $this->returnData('categoriesMenu', $categoriesMenu);
   }// End Index
}
