<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TagController extends Controller
{

    const PATH_VIEW = 'admin.tags.';
    const PATH_UPLOAD = 'tags.';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags=Tag::query()->latest('id')->paginate(5);
        return view(self::PATH_VIEW . 'index', compact('tags'));
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
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Tag::create($request->all());

        return redirect()->route('admin.tags.index')
                         ->with('success', 'Tag created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = Tag::findOrFail($id);
        return view(self::PATH_VIEW . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = Tag::findOrFail($id);
        return view(self::PATH_VIEW . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //     ]);

    //     $tag->update($request->all());

    //     return redirect()->route('tags.index')
    //                      ->with('success', 'Tag updated successfully.');
    // }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tag->update($request->all());

        return redirect()->route('admin.tags.index')
                         ->with('success', 'Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */


     public function destroy(string $id)
     {
        $tag = Tag::find($id);
        $tag->delete();
        return back();
     }
}
