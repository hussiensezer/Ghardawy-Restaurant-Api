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

    return $this->returnData('categories', $categories);
    }// End Index


    public function updateStatus(Request $request,$id) {


        try{
            $rule = [
                'status'    => ['required', 'boolean']
            ];
            $validator = Validator::make($request->all(),$rule);

            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }
            $category = MenuCategory::ownedBusiness()->find($id);

            if(!$category) {
                return $this->returnError('E404' ,'Cannot Found This Category Or Maybe Delete ....');
            }

            $category->update([
                'status'    => $request->status,
            ]);

            return $this->returnSuccessMessage('Status Updated Successful');
        }
        catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }// End UpdateStatus


}
