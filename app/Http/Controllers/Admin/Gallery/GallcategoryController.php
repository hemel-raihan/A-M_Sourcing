<?php

namespace App\Http\Controllers\Admin\Gallery;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Gallery\Gallerycategory;

class GallcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Gallerycategory::all();
        return view('backend.admin.gallery.category.form',compact('categories'));
    }

    public function fetchcategory()
    {
        $categories = Gallerycategory::all();
        return response()->json([
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.gallery.global');
        return view('backend.admin.gallery.category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|unique:gallerycategories',
        ]);
        $slug = Str::slug($request->name);


        $category = Gallerycategory::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // notify()->success("Tax Successfully created","Added");
        // return redirect()->route('admin.taxes.index');
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }


    public function status($id)
    {
        $category = Gallerycategory::find($id);
        if($category->status == true)
        {
            $category->status = false;
            $category->save();

            return response()->json(
                [
                    'status' => 200,
                ]
            );
        }
        elseif($category->status == false)
        {
            $category->status = true;
            $category->save();

            return response()->json(
                [
                    'status' => 200,
                ]
            );
        }

        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery\Gallerycategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function show(Gallerycategory $gallerycategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery\Gallerycategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallerycategory $gallerycategory)
    {
        $programcategoryy = Gallerycategory::find($gallerycategory);
        if($programcategoryy)
        {
            return response()->json(
                [
                    'status' => 200,
                    'programcategory' => $programcategoryy,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Category Not Found'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery\Gallerycategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallerycategory $gallerycategory)
    {
        $category = Gallerycategory::find($request->id);
        $slug = Str::slug($request->name);
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data Updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery\Gallerycategory  $gallerycategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallerycategory $gallerycategory)
    {
        $gallerycategory->delete();
        notify()->success('Category Deleted Successfully','Delete');
        return back();
    }
}
