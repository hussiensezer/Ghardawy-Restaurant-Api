<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaptionStoreRequest;
use App\Http\Requests\CaptionUpdateRequest;
use App\Models\Caption;
use Illuminate\Http\Request;

class CaptionController extends Controller
{

    public function index() {
        $captions = Caption::latest()->paginate(config('setting.LimitPaginate'));

      return view('dashboard.captions.index', compact('captions'));
    }// End Index

    public function create() {
        return view('dashboard.captions.create');
    }// End Create

    public function store(CaptionStoreRequest $request) {

        try {
            $caption = Caption::create([
                'name'  => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'online'=> $request->online,
                'have_order'    => 0,
                'password'  => bcrypt($request->password),
                'admin_id'  => auth()->user()->id,
                'status'    => $request->status,
            ]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store

    public function update(CaptionUpdateRequest $request, $id) {
        try {
            $caption = Caption::findOrFail($id);

            $caption->update([
                'name'  => $request->name,
                'email' => $request->email,
                'password'  => !empty($request->password )? bcrypt($request->password) : $caption->password,
                'status'    => $request->status,
                'online'    => $request->online
            ]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update
}
