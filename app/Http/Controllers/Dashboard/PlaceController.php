<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaceStoreRequest;
use App\Http\Requests\PlaceUpdateRequest;
use App\Models\Category;
use App\Models\Place;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    use ImageTrait;
   public function index()
   {
        $places = Place::latest()->paginate(config('setting.LimitPaginate'));
        return view('dashboard.places.index', compact('places'));
   }// End Index

    public function create()
    {
        $categories = Category::select(['id', 'name'])->where('status',1)->get();

        return view('dashboard.places.create', compact('categories'));
    }// End Create

    public function store(PlaceStoreRequest $request)
    {

        DB::beginTransaction();
        try {
            $place = Place::create([
                'name'                  =>
                    [
                        'ar'            => $request->name_ar ,
                        'en'            => $request->name_en,
                        'ru'            => $request->name_ru
                    ],
                'latitude'              => $request->latitude,
                'longitude'             => $request->longitude,
                'thumb'                 => $this->imageStore($request->thumb, 'files', 'places'),
                'banner'                => $this->imageStore($request->banner, 'files', 'places'),
                'category_id'           => $request->category,
                'admin_id'              => auth()->user()->id,
                'owner_id'              => $request->owner,
                'address'               => $request->address,
                'phone'                 => $request->phone,
                'working_hours'         => $request->working_hours,
                'status'                => $request->status,
                'tax'                   => $request->tax,
                'fees'                  => $request->fees,
                'delivers'              => $request->delivers,
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

    public function edit($id)
    {
       $place = Place::findOrFail($id);
       $categories = Category::select(['id','name'])->get();
       return view('dashboard.places.edit', compact('place', 'categories'));
    }// End Edit

    public function update(PlaceUpdateRequest $request, $id) {
        DB::beginTransaction();
        try {

            $place = Place::findOrFail($id);
            if($request->hasFile('thumb')) {
                $thumb = $this->imageStore($request->thumb, 'files', 'places');
                $this->imageDestroy('files', 'places', $place->getRawOriginal('thumb'));
            }else {
                $thumb =  $place->getRawOriginal('thumb');
            }

            if($request->hasFile('banner')) {
                $banner = $this->imageStore($request->banner, 'files','places');
                $this->imageDestroy('files', 'places',  $place->getRawOriginal('banner'));
            }else {
                $banner = $place->getRawOriginal('banner');
            }

            $place->update([
                'name'                  =>
                    [
                        'ar'            => $request->name_ar ,
                        'en'            => $request->name_en,
                        'ru'            => $request->name_ru
                    ],
                'latitude'              => $request->latitude,
                'longitude'             => $request->longitude,
                'thumb'                 => $thumb,
                'banner'                => $banner,
                'category_id'           => $request->category,
                'owner_id'              => $request->owner,
                'address'               => $request->address,
                'phone'                 => $request->phone,
                'working_hours'         => $request->working_hours,
                'status'                => $request->status,
                'tax'                   => $request->tax,
                'fees'                  => $request->fees,
                'delivers'              => $request->delivers,
            ]);
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
