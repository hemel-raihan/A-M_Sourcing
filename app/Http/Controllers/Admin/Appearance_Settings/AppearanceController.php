<?php

namespace App\Http\Controllers\Admin\Appearance_Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Models\Appearance_Settings\Footersetting;
use App\Models\Appearance_Settings\Navbarsetting;

class AppearanceController extends Controller
{
    public function index()
    {
        Gate::authorize('app.appearance.settings.global');
        $setting = Navbarsetting::find(1);
        return view('backend.admin.appearance_settings.navbar_setting',compact('setting'));
    }

    public function update(Request $request,Navbarsetting $setting)
    {
        // $this->validate($request,[
        //     'facebook_link' => 'required',
        //     'logo' => 'required',
        //     'contact' => 'required',
        // ]);

        $setting->update([
            'navbar_style' => $request->navbar_style,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'left_margin' => $request->left_margin,
            'right_margin' => $request->right_margin,
            'container' => $request->container,
        ]);



        notify()->success("Navbar Successfully Updated","Update");
        return redirect()->route('admin.navbar.settings');
    }

    public function footer_index()
    {
        Gate::authorize('app.appearance.settings.global');
        $footer_setting = Footersetting::find(1);
        return view('backend.admin.appearance_settings.footer_setting',compact('footer_setting'));
    }

    public function footer_update(Request $request,Footersetting $setting)
    {
        // $this->validate($request,[
        //     'facebook_link' => 'required',
        //     'logo' => 'required',
        //     'contact' => 'required',
        // ]);

        $setting->update([
            'footer_style' => $request->footer_style,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'left_margin' => $request->left_margin,
            'right_margin' => $request->right_margin,
            'container' => $request->container,
        ]);



        notify()->success("Footer Successfully Updated","Update");
        return redirect()->route('admin.footer.settings');
    }
}
