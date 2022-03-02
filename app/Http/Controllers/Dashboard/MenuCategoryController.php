<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryMenuStoreRequest;
use App\Http\Requests\CategoryMenuUpdateRequest;
use App\Models\MenuCategory;
use App\Models\Place;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuCategoryController extends Controller
{
    use ImageTrait;

    public function index($id) {
        $place = Place::select(['id','name'])->findOrFail($id);
        $menuCategories = MenuCategory::select(['id', 'name','image', 'place_id', 'sort','status'])
            ->where('place_id', $place->id)
            ->orderBy('sort', 'desc')
            ->paginate(config('setting.LimitPaginate'));
       return view('dashboard.places.menu_categories.index', compact('place', 'menuCategories'));
    }// End Index


    public function create($id) {

        $place = Place::findOrFail($id);

        return view('dashboard.places.menu_categories.create', compact('place'));

    }// End Create

    public function store(CategoryMenuStoreRequest $request,$id) {
        try {
            $place = Place::findOrFail($id);
            $menuCategory = MenuCategory::create([
                'name'      => [
                    'ar'    => $request->name_ar,
                    'en'    => $request->name_en,
                    'ru'    => $request->name_ru
                ],
                'place_id'  => $place->id,
                'admin_id'  => auth()->user()->id,
                'sort'      => $request->sorting,
                'status'    => $request->status,
                'image'     => $this->imageStore($request->icon_category, 'files', 'categoryMenu'),
            ]);

            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }//End Store

    public function update(CategoryMenuUpdateRequest $request, $place,$category) {
        DB::beginTransaction();
        try {
            $category =  MenuCategory::findOrFail($category);

            if($request->hasFile('icon_category')) {
                $image = $this->imageStore($request->icon_category , 'files', 'categoryMenu');
                $destroyImage = $this->imageDestroy('files', 'categoryMenu', $category->image);
            }else {
                $image = $category->image;
            }// End If

            $category->update([
                'name'      => [
                    'ar'    => $request->name_ar,
                    'en'    => $request->name_en,
                    'ru'    => $request->name_ru
                ],
                'sort'      => $request->sorting,
                'status'    => $request->status,
                'image'     => $image,
            ]);// Update
            DB::commit();
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update
}
