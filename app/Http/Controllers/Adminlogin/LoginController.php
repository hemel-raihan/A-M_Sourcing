<?php

namespace App\Http\Controllers\Adminlogin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function showLoginForm()
    {
        return view('adminlogin.login');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/adminlogin');
    }


    public function __construct()
    {
        // if(Auth::check() && Auth::user()->role->id==1)
        // {
        //     $this->redirectTo = route('admin.dashboard');
        // }
        // // elseif(Auth::check() && Auth::user()->role->id==2)
        // // {
        // //     $this->redirectTo = route('author.dashboard');
        // // }
        // // if(Auth::check() && Auth::user()->role->id==3)
        // // {
        // //     $this->redirectTo = route('user.dashboard');
        // // }
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }


}
