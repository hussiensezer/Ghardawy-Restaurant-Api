<?php

namespace App\Http\Controllers\Api\Business;

use App\Http\Controllers\Controller;
use App\Models\MenuCategory;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use GeneralTrait,LanguageTrait;
    public function index(Request $request) {
        $name = $this->LanguageData('language', 'name' , 'categoryMenuName' ,$request);
        $categories = MenuCategory::select(['id', $name,'image', 'status','sort'])
            ->orderBy('sort', 'desc')
            ->ownedBusiness()->paginate(config('setting.LimitPaginate'));
        if(!$categories) {
            return $this->returnError('404', 'Sorry No Categories');
        }
    return $this->returnData('categories', $categories);
    }// End Index


    public function updateStatus($id) {
        try{
            $category = MenuCategory::ownedBusiness()->find($id);

            if(!$category) {
                return $this->returnError('E404', 'Cannot Found This Category Or Maybe Delete ....');
            }
            $mode = $category->status == 1 ? 'Not Available': 'Available' ;
            $category->update([
               'status' => $category->status == 1 ? 0 : 1, //if status true will be false and else false will be true
            ]);


            return $this->returnData('mode' , $mode, 'Status Updated Successful');
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }// End UpdateStatus


}
