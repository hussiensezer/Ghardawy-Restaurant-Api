<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuStoreRequest;
use App\Models\Place;
use App\Models\Size;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    use ImageTrait;

    public function create($id) {
        $place = Place::findOrFail($id);
        $sizes =  Size::select(['id', 'name'])->where('status', 1)->get();
        return view('dashboard.places.menus.create', compact('place','sizes'));
    }// End

    public function store(MenuStoreRequest $request,  $id) {
        DB::beginTransaction();
        try {
            $place = Place::findOrFail($id);

            $menu = $place->menus()->create([
                'name'          => [
                    'ar'        => $request->name_ar,
                    'en'        => $request->name_en,
                    'ru'        => $request->name_ru,
                ],
                'description'   => [
                    'ar'        => $request->description_ar,
                    'en'        => $request->description_en,
                    'ru'        => $request->description_ru
                ],
                'image'         => $this->imageStore($request->image, 'files', 'menus'),
                'status'        => 1,
                'admin_id'      => auth()->user()->id,
            ]);

           if(isset($request->sizes) && !empty($request->sizes)) {
               foreach($request->sizes as $size) {
                   $size = $menu->menuPriceSize()->create([
                       'size_id'  => $size['size'],
                       'price'     => $size['price'],
                       'admin_id'  => auth()->user()->id,
                       'status'    => 1
                   ]);
               }// End ForEach
           }// End If

            if(isset($request->addons) && !empty($request->addons)){
                foreach($request->addons as $addOn) {
                    $addOnMenu = $menu->addOn()->create([
                        'name'      => [
                            'ar'    => $addOn['addons_name_ar'],
                            'en'    => $addOn['addons_name_en'],
                            'ru'    => $addOn['addons_name_ru'],
                        ],
                        'price'     => $addOn['addons_price'],
                        'status'    =>1,
                        'admin_id'  => auth()->user()->id,
                    ]);
                }// End Foreach
            }// End If





            DB::commit();
            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store
}
