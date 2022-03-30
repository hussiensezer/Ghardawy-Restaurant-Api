<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Traits\ImageTrait;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    use ImageTrait;
    public function index() {
        $categories = Category::orderBy('sorting' , 'asc')->with(['adminId'])->latest()->paginate(config('setting.LimitPaginate'));
        return view("dashboard.categories.index", compact('categories'));
    }// End Index

    public function create() {
        return view("dashboard.categories.create");
    }// End Create

    public function store(CategoryStoreRequest $request) {
        DB::beginTransaction();
        try {
            $category = Category::create([
                'name'              =>
                [
                    'ar'            => $request->name_ar ,
                    'en'            => $request->name_en,
                    'ru'            => $request->name_ru
                ],
                'slug'              => $request->slug,
                'seo'               => $request->seo,
                'meta_description'  => $request->meta_desc,
                'category_image'    => $this->imageStore($request->icon_category,'files', 'category'),
                'admin_id'          => auth()->user()->id,
                'sorting'           => $request->sorting,
                'status'            => $request->status,
            ]);
            DB::commit();
            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store

    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('dashboard.categories.edit', compact('category'));
    }// End Edit

    public function update(CategoryUpdateRequest $request, $id) {

        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);

            if($request->hasFile('icon_category')) {
                    $image =  $this->imageStore($request->icon_category, 'files', 'category');
                              $this->imageDestroy('files', 'category', $category->getRawOriginal('category_image'));
            }else {
                    $image = $category->getRawOriginal('category_image');
            }// End If
            $category->update([
                'name'              =>
                    [
                        'ar'            => $request->name_ar ,
                        'en'            => $request->name_en,
                        'ru'            => $request->name_ru
                    ],
                'slug'              => $request->slug,
                'seo'               => $request->seo,
                'meta_description'  => $request->meta_desc,
                'category_image'    => $image,
                'sorting'           => $request->sorting,
                'status'            => $request->status,
            ]);
            DB::commit();
            toastr()->info(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update
}
