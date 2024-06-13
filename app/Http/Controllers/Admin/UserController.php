<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddressDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    const PATH_VIEW = 'admin.users.';
    const PATH_UPLOAD = 'users';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=User::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . __FUNCTION__,compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $address_details = AddressDetail::query()->pluck('address','id')->all();
        return view(self::PATH_VIEW . __FUNCTION__, compact(['address_details']));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->except('photo_thumbs');
        $data['is_active'] ??= 0;
        if($request->except('photo_thumbs')){
            $data['photo_thumbs']=Storage::put(self::PATH_UPLOAD,$request->file('photo_thumbs'));
        }
        User::query()->create($data);

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model=User::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $model=User::query()->findOrFail($id);

        return view(self::PATH_VIEW . __FUNCTION__, compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $model=User::query()->findOrFail($id);
        $data=$request->except('photo_thumbs');
        if($request->except('photo_thumbs')){
            $data['photo_thumbs']=Storage::put(self::PATH_UPLOAD,$request->file('photo_thumbs'));
        }

        $current_image=$model->photo_thumbs;

        $model->update($data);

        if($current_image&& Storage::exists($current_image)){
            Storage::delete($current_image);
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model=User::query()->findOrFail($id);

        $model->delete();

        if($model->photo_thumbs && Storage::exists($model->photo_thumbs)){
            Storage::delete($model->photo_thumbs);
        }

        return back();
    }
}
