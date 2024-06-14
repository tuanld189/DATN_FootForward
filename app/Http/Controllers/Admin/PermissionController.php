<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions=Permission::get();
        return view('admin.role-permission.permissions.index',[
            'permissions'=>$permissions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.role-permission.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name',
            ]
            ]);
            Permission::create([
                'name'=>$request->name,
            ]);
            return redirect('permissions')->with('status','Permission Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {

        return view('admin.role-permission.permissions.edit',[
            'permission'=>$permission
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name'=>[
                'required',
                'string',
                'unique:permissions,name,'.$permission->id,
            ]
            ]);
            $permission->update([
                'name'=>$request->name,
            ]);
            return redirect('permissions')->with('status','Permission Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($permissionId)
    {
        $permission=Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status','Permission Deleted Successfully');
    }
}
