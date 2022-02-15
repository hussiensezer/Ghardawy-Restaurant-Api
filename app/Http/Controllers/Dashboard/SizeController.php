<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\SizeStoreRequest;
use App\Http\Requests\SizeUpdateRequest;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index() {

        $sizes = Size::select(['id', 'name','status','admin_id'])
            ->with
            ([
                'adminId' => function($q) {
                    $q->select(['id', 'name']);
                }
            ])
            ->latest()
            ->paginate(config('setting.LimitPaginate'));
        return view('dashboard.sizes.index', compact('sizes'));

    }// End Index

    public function create() {

        return view('dashboard.sizes.create');
    }// End Create

    public function store(SizeStoreRequest $request) {
        try {

            $size = Size::create([
                'name'      => [
                    'ar'    => $request->name_ar,
                    'en'    => $request->name_en,
                    'ru'    => $request->name_ru
                ],
                'status'    => $request->status,
                'admin_id'  => auth()->user()->id
            ]);

            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }

    }// End Create

    public function edit($id) {
        $size = Size::findOrFail($id);

        return view('dashboard.sizes.edit', compact('size'));

    }// End Edit

    public function update(SizeUpdateRequest $request,$id) {

        try {
            $size = Size::findOrFail($id);

            $size->update([
                'name'      => [
                    'ar'    => $request->name_ar,
                    'en'    => $request->name_en,
                    'ru'    => $request->name_ru
                ],
                'status'    => $request->status,
            ]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update
}
