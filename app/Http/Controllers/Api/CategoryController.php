<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   use GeneralTrait, LanguageTrait;

   public function index(Request $request) {

       $lang = $this->LanguageData('language', 'name' , 'categoryName' ,$request);
       $categories = Category::select(['id',$lang, 'slug','category_image'])->where("status", 1)->get();
       return $this->returnData('categories', $categories);


   }
}
