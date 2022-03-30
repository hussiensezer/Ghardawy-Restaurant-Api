<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OwnerStoreRequest;
use App\Http\Requests\OwnerUpdateRequest;
use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
   public function index() {
       $owners = Owner::with([
           'place' => function($q) {
                $q->select(['id','name', 'owner_id']);
           }
       ])->latest()->paginate(config('setting.LimitPaginate'));
       return view('dashboard.owners.index', compact('owners'));
   }// End Index

    public function store(OwnerStoreRequest $request) {
        try {
            $owner = Owner::create([
                'name'  => $request->name,
                'password'  => bcrypt($request->password),
                'email'     => $request->email,
                'status'    => $request->status,
                'phone'     => $request->phone,
                'admin_id'  => auth()->user()->id,
            ]);
            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store


    public function update(OwnerUpdateRequest $request, $id) {
        try {
            $owner = Owner::findOrFail($id);
            $owner->update([
                'name'  => $request->name,
                'password'  => !empty($request->password) ? bcrypt($request->password) : $owner->password,
                'email'     => $request->email,
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
