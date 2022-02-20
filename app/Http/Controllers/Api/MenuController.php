<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Traits\GeneralTrait;
use App\Traits\LanguageTrait;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use LanguageTrait, GeneralTrait;
    public function index(Request $request, $id) {

        $name = $this->LanguageData('language', 'name', 'itemName',  $request);
        $description = $this->LanguageData('language', 'description', 'itemDescription',  $request);

        $menus = Menu::select(['id', $name ,$description,'image'])
            ->where('place_id', '=', $id)->get();

        return $this->returnData('menu', $menus);
    }// End Index
}
