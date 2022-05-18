<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.roles.self');
        $roles = Role::withCount('permissions')->get();
        Artisan::call('cache:clear');
        return view('backend.admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::with('permissions')->get();
        Artisan::call('cache:clear');
        return view('backend.admin.roles.form',compact('modules'));
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
            'name' => 'required|unique:roles',
            'permissions' => 'required|array',
            'permissions.*' => 'integer',
        ]);
        Role::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ])->permissions()->sync($request->input('permissions'),[]);

        Artisan::call('cache:clear');
        notify()->success("Role Successfulyy Ceated", "Added");
        return redirect()->route('admin.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $modules = Module::with('permissions')->get();
        Artisan::call('cache:clear');
        return view('backend.admin.roles.form',compact('modules','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        $role->permissions()->sync($request->input('permissions'));

        Artisan::call('cache:clear');
        notify()->success("Role Successfully Updated","Updated");
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if($role->deletable)
        {
            $role->delete();
            notify()->success("Role succesffully Deleted","Delete");
        }
        else
        {
            notify()->success("You can't delete this ","Delete");
        }

        Artisan::call('cache:clear');
        return back();
    }

    public function autocomplete(Request $request)
    {
        $role = Role::find($request->id);
        $query = $request->input('query');
        //$search_news = Page::where('title','LIKE',"%$query%")->where('status',1)->get();

        $search_news = Module::where('name','LIKE','%'.$query.'%')->get();
        $modules = Module::with('permissions')->get();
        return view('backend.admin.roles.form',compact('search_news','query','modules','role'));
    }
}
