<?php

namespace App\Http\Controllers\Admin;

use mysqli;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function index()
    {
        Gate::authorize('app.dashboard');
        Artisan::call('cache:clear');
        
        return view('backend.admin.dashboard');
    }
    public function author()
    {
        Artisan::call('cache:clear');
        return view('admin.author');
    }
}
