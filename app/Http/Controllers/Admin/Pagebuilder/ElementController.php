<?php

namespace App\Http\Controllers\Admin\Pagebuilder;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\blog\category;
use App\Models\Career\Jobcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Models\Pagebuilder\Pagebuilder;
use App\Models\Product\Productcategory;

class ElementController extends Controller
{
    public function index($id)
    {
        //Gate::authorize('app.build.pages.pagebuilder');
        $page = Pagebuilder::findOrFail($id);
        $auth = Auth::guard('admin')->user();
        return view('backend.admin.pagebuilder.element.index',compact('page','auth'));
    }

    public function create($id)
    {
        $page = Pagebuilder::findOrFail($id);
        $categories = category::withCount('posts')->get(['id']);
        $product_categories = Productcategory::withCount('products')->get(['id']);
        $job_categories = Jobcategory::withCount('jobs')->get(['id']);
        return view('backend.admin.pagebuilder.element.form',compact('page','categories','product_categories','job_categories'));
    }

    public function store(Request $request,$id)
    {
        $page = Pagebuilder::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/elementphoto');
            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = null;
        }

        $gallaryimage = $request->file('galleryimg');
        $images=array();
        $destination = public_path('uploads/elementgalleryphoto');

        if(isset($gallaryimage))
        {
            foreach($gallaryimage as $gimage)
            {
               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               //$gimg = Image::make($gimage)->resize(900,600)->save($gallaryimagename,90);
               $gimg                     =       Image::make($gimage->path());
               $gimg->resize(900, 600, function ($constraint) {
                   $constraint->aspectRatio();
               })->save($destination.'/'.$gallaryimagename);
               //$gimage->move($destination,$gallaryimagename);
               //Storage::disk('public')->put('pagegallary_image/'.$gallaryimagename,$gimg);
               $images[]=$gallaryimagename;
            }
        }
        else
        {
            $image = null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->title_show)
        {
            $title_show = 0;
        }
        else
        {
            $title_show = 1;
        }

        $page->elements()->create([
            'category_id' => $request->category_id,
            'product_category_id' => $request->product_category_id,
            'job_category_id' => $request->job_category_id,
            'title' => $request->title,
            'module_type' => $request->module_type,
            'container' => $request->container,
            'layout' => $request->layout,
            'post_qty' => $request->post_qty,
            'portfolio_width' => $request->portfolio_width,
            'image' => $imagename,
            'galleryimg'=>  implode("|",$images),
            'img_width' => $request->img_width,
            'img_height' => $request->img_height,
            'img_margin' => $request->img_margin,
            'margin_top' => $request->margin_top,
            'margin_bottom' => $request->margin_bottom,
            'img_topmargin' => $request->img_topmargin,
            'topmargin_amt' => $request->topmargin_amt,
            'body' => $request->body,
            'status' => $status,
            'title_show' => $title_show,
            'title_color' => $request->title_color,


        ]);
        notify()->success("Element Successfully created","Added");
        return redirect()->route('admin.element.index',$id);
    }

    public function edit($id,$elementId)
    {
        $auth = Auth::user();
        $page = Pagebuilder::findOrFail($id);
        $element = $page->elements()->findOrFail($elementId);
        $editcategories = category::withCount('posts')->get(['id']);
        $product_editcategories = Productcategory::withCount('products')->get(['id']);
        $job_editcategories = Jobcategory::withCount('jobs')->get(['id']);
        return view('backend.admin.pagebuilder.element.form',compact('page','auth','element','editcategories','product_editcategories','job_editcategories'));
    }

    public function update(Request $request,$id,$elementId)
    {
        //Gate::authorize('app.menus.edit');
        $page = Pagebuilder::findOrFail($id);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $sidebarphotoPath = public_path('uploads/elementphoto');

            $sidebarphoto_path = public_path('uploads/elementphoto/'.$page->elements()->findOrFail($elementId)->image);  // Value is not URL but directory file path
            if (file_exists($sidebarphoto_path)) {

                @unlink($sidebarphoto_path);

            }

            $image->move($sidebarphotoPath,$imagename);

        }
        else
        {
            $imagename = $page->elements()->findOrFail($elementId)->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('galleryimg');
        $images=array();
        $destination = public_path('uploads/elementgalleryphoto');
        $updateimages = explode("|", $page->elements()->findOrFail($elementId)->galleryimg);

        if(isset($gallaryimage))
        {

            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/elementgalleryphoto/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

            foreach($gallaryimage as $gimage)
            {

               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               //$gimage->move($destination,$gallaryimagename);
               $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
               $images[]=$gallaryimagename;
            }

        }
        else
        {
            $images[]= $page->elements()->findOrFail($elementId)->galleryimg;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->title_show)
        {
            $title_show = 0;
        }
        else
        {
            $title_show = 1;
        }

        $page->elements()->findOrFail($elementId)->update([
            'category_id' => $request->category_id,
            'product_category_id' => $request->product_category_id,
            'job_category_id' => $request->job_category_id,
            'title' => $request->title,
            'module_type' => $request->module_type,
            'container' => $request->container,
            'layout' => $request->layout,
            'post_qty' => $request->post_qty,
            'portfolio_width' => $request->portfolio_width,
            'image' => $imagename,
            'gallaryimage'=>  implode("|",$images),
            'img_width' => $request->img_width,
            'img_height' => $request->img_height,
            'img_margin' => $request->img_margin,
            'margin_top' => $request->margin_top,
            'margin_bottom' => $request->margin_bottom,
            'img_topmargin' => $request->img_topmargin,
            'topmargin_amt' => $request->topmargin_amt,
            'body' => $request->body,
            'status' => $status,
            'title_show' => $title_show,
            'title_color' => $request->title_color,
        ]);

        notify()->success('Element Updated','Update');
        return redirect()->route('admin.element.index',$id);
    }

    public function destroy($id,$elementId)
    {
        $page = Pagebuilder::findOrFail($id);

        $sidebarphoto_path = public_path('uploads/elementphoto/'.$page->elements()->findOrFail($elementId)->image);  // Value is not URL but directory file path
        if (file_exists($sidebarphoto_path)) {

            @unlink($sidebarphoto_path);

        }

        $destination = public_path('uploads/elementgalleryphoto');
        $updateimages = explode("|", $page->elements()->findOrFail($elementId)->galleryimg);


            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/elementgalleryphoto/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

        Pagebuilder::findOrFail($id)
                 ->elements()
                 ->findOrFail($elementId)
                 ->delete();

        notify()->success('Element Delete Successfully');
        return back();
    }
}
