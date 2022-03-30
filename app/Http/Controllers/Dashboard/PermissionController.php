<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPermissionStoreRequest;
use App\Http\Requests\AdminPermissionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index() {
        $roles = Role::where('guard_name', 'admins')->latest()->paginate(config('setting.LimitPaginate'));
        $permissions = Permission::select(['id','name'])->where('guard_name' , 'admins')->get();
        return view("dashboard.permissions.index", compact('roles', 'permissions'));
    }// End Index

    public function store(AdminPermissionStoreRequest $request) {
        try {
            $role = Role::create([
                "name" => $request->name,
                'guard_name' => 'admins'
            ]);
            $role->givePermissionTo([$request->permissions]);
            toastr()->success(__('global.success_create'));
            return redirect()->back();
        }
        catch (\Exception $e) {

            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Store
    public function edit($id) {
        $role = Role::select(['id','name'])->with([
            'permissions'   => function($q) {
                $q->select(['id']);
            }
        ])->where('name' ,'!=', 'Super Admin')->findOrFail($id);

        $permissions = Permission::select(['id','name'])->where('guard_name' , 'admins')->get();

        $rolePermissions = [];

        foreach($role->permissions  as $permission) {
            $rolePermissions[] = $permission->id;
        }
        return view("dashboard.permissions.edit", compact('role', 'permissions','rolePermissions'));
    }// End Edit

    public function update(AdminPermissionUpdateRequest $request,$id) {
        DB::beginTransaction();
        try {
            $role = Role::with([
                'permissions' => function($query) {
                    $query->select(['id','name']);
                }])->where("name" ,"!=",'Super Admin')->findOrFail($id);

            foreach($role->permissions  as $permission) {
                $role->revokePermissionTo($permission->name);

            }
            $role->givePermissionTo([$request->permissions]);
            DB::commit();
            toastr()->info(__('global.success_update'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Update










    public function destroy($id) {
        DB::beginTransaction();
        try {
            $role = Role::where("name", "!=", 'Super Admin')
                ->with([
                    'permissions' => function($q) {
                        $q->select(['id', 'name']);
                    }
                ])->findOrFail($id);

            foreach($role->permissions  as $permission) {
                $role->revokePermissionTo($permission->name);

            }
            $role->delete();
            DB::commit();
            toastr()->success(__('global.success_delete'));
            return redirect()->back();
        }
        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()] );

        }
    }// End Destroy
}
