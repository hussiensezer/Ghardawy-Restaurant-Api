<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    use LanguageTrait, GeneralTrait;
    public function index(Request $request, $id) {

        $name = $this->LanguageData('language', 'name', 'itemName',  $request);
        $description = $this->LanguageData('language', 'description', 'itemDescription',  $request);
        $addOnName =  $this->LanguageData('language', 'name', 'addOnName',  $request);
        $sizeName = $this->LanguageData('language', 'name', 'sizeName',  $request);

        $menu = Menu::select(['id', $name ,$description,'image'])
            ->with([
              'addOn' => function($q) use($addOnName)
              {
                $q->select(['id',$addOnName , 'price','menu_id'])->where('status', 1);

              },// End Add-Ons
              'menuPriceSize' => function($q) use ($sizeName) {
                $q->select(['id', 'price', 'menu_id','size_id'])
                    ->with([
                        'sizeId' => function($q) use($sizeName){
                            $q->select(['id',$sizeName]);
                        }
                    ]);
              }// End MenuPriceSize
            ])->find($id);

        return $this->returnData('item', $menu);
    }// End Index

    protected function language() {

    }// End Language
}
