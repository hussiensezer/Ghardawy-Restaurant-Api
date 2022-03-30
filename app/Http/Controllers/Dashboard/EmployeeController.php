<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminStoreRequest;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{

    public function index() {
        $employees =  Admin::latest()->paginate(config('setting.LimitPaginate'));
        $roles = Role::select(['id', 'name'])->get();
        return view("dashboard.employees.index", compact('employees', 'roles'));
    }// End Index

    public function edit($id) {
        $employee = Admin::findOrFail($id);
        $rs = Role::select(['id', 'name'])->get();
        $userRole = $employee->roles->first();

      return view("dashboard.employees.edit", compact('employee', 'rs', 'userRole'));
    }
    public function store(AdminStoreRequest $request) {
        try {
            $admin = Admin::create([
                'name'  => $request->name,
                'password'  => bcrypt($request->password),
                'email'     => $request->email,
                'status'    => $request->status,
                'phone'     => $request->phone,
            ]);
            $admin->assignRole($request->role);
            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store

    public function update(AdminUpdateRequest $request, $id) {
        try {
            $employee = Admin::findOrFail($id);

            $employee->update([
                'name'  => $request->name,
                'password'  => !empty($request->password) ? bcrypt($request->password) : $employee->password,
//                'email'     => $request->email,
                'status'    => $request->status,
            ]);
            $employee->syncRoles([$request->role]);
            toastr()->success(__('global.success_update'));
            return redirect()->back();

        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }
}
