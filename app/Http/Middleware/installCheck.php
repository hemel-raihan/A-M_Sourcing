<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class installCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->alreadyInstalled()) {
            return $next($request);
        }
        else
        {
            return redirect('install');
        }
    }

    public function alreadyInstalled()
    {
        return file_exists(storage_path('installed'));
    }
}
