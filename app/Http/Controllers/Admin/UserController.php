<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_UPLOAD = 'users';

    public function index()
    {
        $users = User::latest('id')->get();
        return view('admin.users.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.index', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|max:20',
            'phone' => 'required|string|max:10',
            'photo_thumbs' => 'required|image',
            'status' => 'required|string|max:255',
            'roles' => 'required|array', // Validate roles as an array
        ]);

        $data = $request->except('photo_thumbs');
        $data['is_active'] ??= 0;

        if ($request->hasFile('photo_thumbs')) {
            $data['photo_thumbs'] = Storage::put(self::PATH_UPLOAD, $request->file('photo_thumbs'));
        }

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        // Assign roles to the user
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('status', 'User Created Successfully');
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:10',
            'photo_thumbs' => 'nullable|image',
            'status' => 'required|string|max:255',
            'roles' => 'required|array', // Validate roles as an array
        ]);

        $data = $request->except('photo_thumbs');

        if ($request->hasFile('photo_thumbs')) {
            $data['photo_thumbs'] = Storage::put(self::PATH_UPLOAD, $request->file('photo_thumbs'));
            if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
                Storage::delete($user->photo_thumbs);
            }
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        // Update roles
        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('status', 'User Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
            Storage::delete($user->photo_thumbs);
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'User Deleted Successfully');
    }
}
