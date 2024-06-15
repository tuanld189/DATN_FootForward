<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vourcher;
// use Carbon\Carbon;
use Illuminate\Http\Request;

class VourcherController extends Controller
{
    const PATH_VIEW = 'admin.vourchers.';
    const PATH_UPLOAD = 'vourchers';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vourchers = Vourcher::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . 'index', compact('vourchers'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(self::PATH_VIEW . 'create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate  ([
            'code' => 'required|unique:vourchers|max:255',
            'discount' => 'required|numeric',
            'description' => 'nullable',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'required|boolean',
        ]);

        // Kiểm tra nếu end_date đã qua, đặt is_active thành false
        // if (Carbon::now()->isAfter($request->end_date)) {
        //     $request->merge(['is_active' => false]);
        // }

        Vourcher::create($request->all());

        return redirect()->route('admin.vourchers.index')
            ->with('success', 'Vourcher created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Vourcher::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Vourcher::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $id)
    {
        $model = Vourcher::findOrFail($id);
        $request->validate([
            'code' => 'nullable|max:255|unique:vourchers,code,' . $model->id,
            'discount' => 'nullable|numeric',
            'description' => 'nullable',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',
            'is_active' => 'nullable|boolean',
        ]);

        // Kiểm tra nếu end_date đã qua, thì tự đặt is_active thành false
        // if (Carbon::now()->isAfter($request->end_date)) {
        //     $request->merge(['is_active' => false]);
        // }

        $model->update($request->all());

        return redirect()->route('admin.vourchers.index')
            ->with('success', 'Vourcher updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    // }

    public function destroy(string $id)
    {
        $vourcher = Vourcher::find($id);
        $vourcher->delete();
        return back();
    }
}
