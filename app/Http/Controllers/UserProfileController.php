<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('client.profile.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'photo_thumbs' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('photo_thumbs');

        if ($request->hasFile('photo_thumbs')) {
            if ($user->photo_thumbs && Storage::exists($user->photo_thumbs)) {
                Storage::delete($user->photo_thumbs);
            }

            $path = Storage::put('public/users', $request->file('photo_thumbs'));
            $data['photo_thumbs'] = $path;
        }

        $user->update($data);

        return redirect()->route('client.profile.edit', $user->id)->with('status', 'Cập nhật hồ sơ thành công!');
    }
}
