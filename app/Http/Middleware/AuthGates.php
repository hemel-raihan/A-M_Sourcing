<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;

class AuthGates
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::guard('admin');
        // if (Schema::hasTable('permissions'))
        // {
            if($user)
            {
                $permissions = Permission::all();

                foreach($permissions as $key=>$permission)
                {
                    Gate::define($permission->slug,function(Admin $admin) use($permission)
                    {
                        return $admin->hasPermission($permission->slug);
                    });
                }
            }
       // }

        return $next($request);
    }
}
