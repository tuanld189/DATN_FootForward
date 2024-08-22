<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }
    public function toggleStatus(Request $request)
    {
        $permission = Permission::find($request->id);
        if ($permission) {
            $permission->is_active = $request->is_active;
            $permission->save();
            return response()->json(['success' => 'Trạng thái đã được cập nhật.']);
        } else {
            return response()->json(['error' => 'Không tìm thấy quyền.'], 404);
        }
    }
    public function create()
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        $permission = Permission::create($request->all());
        return redirect()->route('admin.permissions.index');
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($request->all());
        return redirect()->route('admin.permissions.index');
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return redirect()->route('admin.permissions.index');
    }
}
