<?php

namespace App\Http\Controllers\Api\Business;

use App\Http\Controllers\Controller;
use App\Models\Addon;
use App\Models\Menu;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    use GeneralTrait, LanguageTrait;
    public function index(Request $request, $id) {
        $name = $this->LanguageData('language', 'name', 'itemName',  $request);
        $addOnName =  $this->LanguageData('language', 'name', 'addOnName',  $request);

        $menus = Menu::select(['id',$name ,'image','status'])
            ->with([
                'addOn' => function($q) use($addOnName){
                    $q->select(['id', $addOnName,'menu_id','status']);
                }
            ])->ownedBusiness()
            ->paginate(config('setting.LimitPaginate'));

        return $this->returnData('menu', $menus);
    }// End Index

    public function updateMenuStatus(Request $request,$id) {
      try {
          $rule = [
              'status'    => ['required', 'boolean']
          ];
          $validator = Validator::make($request->all(),$rule);
          if($validator->fails()) {
              $code = $this->returnCodeAccordingToInput($validator);
              return $this->returnValidationError($code , $validator);
          }
          $menu = Menu::ownedBusiness()->find($id);
          if(!$menu) {
              return $this->returnError('E404' ,'Cannot Found This Item Or Maybe Delete ....');
          }

          $menu->update([
              'status'    => $request->status,
          ]);
          return $this->returnSuccessMessage('Status Updated Successful');
      }catch (\Exception $e) {
          return $this->returnError('',$e->getMessage());
      }


    }// End Update Menu Status

    public function updateAddonsStatus(Request $request, $id) {

        try {
            $rule = [
                'status'    => ['required', 'boolean']
            ];
            $validator = Validator::make($request->all(),$rule);
            if($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code , $validator);
            }

            // Find Addons
            $addOn =  Addon::find($id);

            if(!$addOn) {
                return $this->returnError('E404', 'The Add-On Not Found Or Delete');
            }
            //The Menu Of It

            $menu = Menu::where([
                ['id', $addOn->menu_id],
            ])->ownedBusiness()->get();

            if($menu) {
                $addOn->update([
                   'status' => $request->status
                ]);
                return $this->returnSuccessMessage('Status Updated Successful');
            }else {
                return $this->returnError('E404', 'The Add-On Not Found Or Delete');
            }
        }catch (\Exception $e) {
            return $this->returnError('',$e->getMessage());
        }
    }// End Update Add-Ons Status
}
