<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.users.self');
        $users = Admin::where('role_id','!=',1)->get();
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.admins.index',compact('users','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.users.create');
        $roles = Role::all();
        $auth = Auth::user();
        Artisan::call('cache:clear');
        return view('backend.admin.admins.form',compact('roles','auth'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.users.create');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:admins|max:255',
            'role_id' => 'required',
            'password' => 'required|confirmed|string|min:6',
        ]);

        $user = Admin::create([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Artisan::call('cache:clear');
        notify()->success("User added succefully");
        return redirect()->route('admin.admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        Gate::authorize('app.users.edit');
        $roles = Role::all();
        Artisan::call('cache:clear');
        return view('backend.admin.admins.form',compact('roles','admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        Gate::authorize('app.users.edit');
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
            'password' => 'nullable|confirmed|string|min:6',
        ]);

        $admin->update([
            'role_id' => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => isset($request->password) ? Hash::make($request->password) : $admin->password
        ]);

        Artisan::call('cache:clear');
        notify()->success("user Updated Successfully");
        return redirect()->route('admin.admins.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //Gate::authorize('app.users.destroy');
        $admin->delete();
        Artisan::call('cache:clear');
        notify()->success("User Delete Succefully");
        return back();
    }
}
