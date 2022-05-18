<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword()
    {
        return view('backend.admin.profile.password');
    }

    public function changeProfile()
    {
        return view('backend.admin.profile.profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.Auth::id(),
        ]);

        $user = Auth::guard('admin')->user();
        $hashedPassword = $user->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            notify()->success("profile update Successfully","Updated");
            return back();
        }
        else
        {
            notify()->error('Old Password not matched','Error');
            return back();
        }

    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::guard('admin')->user();

        $hashedPassword = $user->password;
        if(Hash::check($request->old_password,$hashedPassword))
        {
            if(!Hash::check($request->password,$hashedPassword))
            {
                if(!Hash::check($request->password,$request->password_confirmation))
                {
                    $user->update([
                        'password' => Hash::make($request->password),
                    ]);
                    Auth::logout();
                    return redirect()->route('admin.login');
                }
                else
                {
                    notify()->error('Confirm password not matching with new password','Error');
                }

            }
            else
            {
                notify()->warning('New Password can not be same as old password','Error');
            }
        }
        else
        {
            notify()->error('Old Password not matched','Error');
        }
        return back();
    }
}
