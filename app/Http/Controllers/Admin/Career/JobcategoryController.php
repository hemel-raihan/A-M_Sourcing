<?php

namespace App\Http\Controllers\Admin\Career;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Career\Jobcategory;
use App\Http\Controllers\Controller;

class JobcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Jobcategory::all();
        return view('backend.admin.career.category.form',compact('categories'));
    }

    public function fetchcategory()
    {
        $categories = Jobcategory::all();
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
        return view('backend.admin.career.category.form');
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
            'name' => 'required|unique:jobcategories',
        ]);
        $slug = Str::slug($request->name);


        $category = Jobcategory::create([
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
        $category = Jobcategory::find($id);
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
     * @param  \App\Models\Career\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Jobcategory $jobcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobcategory $jobcategory)
    {
        $programcategoryy = Jobcategory::find($jobcategory);
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
     * @param  \App\Models\Career\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobcategory $jobcategory)
    {
        $category = Jobcategory::find($request->id);
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
     * @param  \App\Models\Career\Jobcategory  $jobcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobcategory $jobcategory)
    {
        $jobcategory->delete();
        notify()->success('Category Deleted Successfully','Delete');
        return back();
    }
}
