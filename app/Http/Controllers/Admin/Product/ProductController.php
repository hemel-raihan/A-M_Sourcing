<?php

namespace App\Http\Controllers\Admin\Product;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Admin\Sidebar;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use App\Models\Product\Productcategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.product.posts.self');
        //$posts = Auth::guard('admin')->user()->posts()->latest()->get();
        $auth = Auth::guard('admin')->user();
        $posts = Product::with('productcategories')->latest()->paginate(5);
        return view('backend.admin.product.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.product.posts.create');
        $categories = Productcategory::with('childrenRecursive')->where('parent_id', '=', 0)->get();
        // $subcat = Productcategory::all();
        // $sidebars = Sidebar::all();
        return view('backend.admin.product.post.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.product.posts.create');
            $this->validate($request,[
                'title' => 'required|unique:products',
                'image' => 'max:1024',
                'gallaryimage.*' => 'max:1024',
                'files' => 'mimes:pdf',
                'categories' => 'required',
            ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/productphoto');
            $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);
            //$img->save($postphotoPath.'/'.$imagename,60,'jpg');

        }
        else
        {
            $imagename = null;
        }


         //get form Gallary image
         $gallaryimage = $request->file('gallaryimage');
         $images=array();
         $destination = public_path('uploads/productgallary_image');

         if(isset($gallaryimage))
         {
             foreach($gallaryimage as $gimage)
             {
                $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
                 $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
                $images[]=$gallaryimagename;
             }

         }
         else
         {
            $images[] = null;
         }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productfiles');

            // //check image folder existance
            // if(!Storage::disk('public')->exists('postfile'))
            // {
            //     Storage::disk('public')->makeDirectory('postfile');
            // }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!$request->cash_on_delivery)
        {
            $cash_on_delivery = 0;
        }
        else
        {
            $cash_on_delivery = 1;
        }

        if(!$request->todays_deal)
        {
            $todays_deal = 0;
        }
        else
        {
            $todays_deal = 1;
        }

        if($request->Free_Shipping)
        {
            $shipping = null;
        }
        else
        {
            $shipping = $request->Free_Shipping;
        }

        if($request->Flat_Rate)
        {
            $shipping = $request->shipping;
        }

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }

        if(!$request->youtube_link)
        {
            $youtube = null;
        }
        else
        {
            $youtube = $request->youtube_link;
        }

        if(!$request->image)
        {
            $featureimg = null;
        }
        else
        {
            $featureimg = $imagename;
        }



        $product = Product::create([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'unit' => $request->unit,
            'purchase_qty' => $request->purchase_qty,
            'low_stock_qty' => $request->low_stock_qty,
            'unit_price' => $request->unit_price,
            'discount_startdate' => $request->discount_startdate,
            'discount_enddate' => $request->discount_enddate,
            'discount_rate' => $request->discount_rate,
            'discount_type' => $request->discount_type,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'image' => $featureimg,
            'youtube_link' => $youtube,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'desc' => $request->desc,
            'shipping' => $shipping,
            'cash_on_delivery' => $cash_on_delivery,
            'todays_deal' => $todays_deal,
            'estimate_shipping_time' => $request->estimate_shipping_time,
            'tax_type' => $request->tax_type,
            'tax' => $request->tax,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);

        //for many to many
        $product->productcategories()->attach($request->categories);


        notify()->success("Product Successfully created","Added");
        return redirect()->route('admin.products.index');
    }


    public function status($id)
    {
        Gate::authorize('app.product.posts.status');
        $post = Product::find($id);
        if($post->status == true)
        {
            $post->status = false;
            $post->save();

            notify()->success('Successfully Deactiveated Post');
        }
        elseif($post->status == false)
        {
            $post->status = true;
            $post->save();

            notify()->success('Removed the Activeated Approval');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        Gate::authorize('app.product.posts.edit');
        $categories = Productcategory::with('childrenRecursive')->where('parent_id', '=', 0)->get();
        // $subcat = Productcategory::all();
        // $editsidebars = Sidebar::all();
        return view('backend.admin.product.post.form',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        Gate::authorize('app.product.posts.edit');
        $this->validate($request,[
            'title' => 'required',
            'image' => 'max:1024',
            'gallaryimage.*' => 'max:1024',
            'files' => 'mimes:pdf',
            'categories' => 'required',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/productphoto');

            $postphoto_path = public_path('uploads/productphoto/'.$product->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
            $img->resize(900, 600)->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $product->image;
        }

        //get form Gallary image
        $gallaryimage = $request->file('gallaryimage');
        $images=array();
        $destination = public_path('uploads/productgallary_image');
        $updateimages = explode("|", $product->gallaryimage);


        if(isset($gallaryimage))
        {
            foreach($updateimages as $updateimage){

                $gallary_path = public_path('uploads/productgallary_image/'.$updateimage);

                if (file_exists($gallary_path)) {

                    @unlink($gallary_path);

                }
            }

            foreach($gallaryimage as $gimage)
            {

               $gallaryimagename = $slug.'-'.'-'.uniqid().'.'.$gimage->getClientOriginalExtension();
               $gimg                     =       Image::make($gimage->path());
                $gimg->resize(900, 600, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destination.'/'.$gallaryimagename);
               $images[]=$gallaryimagename;
            }

        }
        else
        {
            $images[]=$product->gallaryimage;
        }

        //get form file
        $file = $request->file('files');

        if(isset($file))
        {
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/productfiles');


            $file_path = public_path('uploads/productfiles/'.$product->files);  // Value is not URL but directory file path
            if (file_exists($file_path)) {

                @unlink($file_path);

            }
            $file->move($destinationPath,$filename);

            // //resize image
            // $postfile = Image::make($file)->save($filename);
            // Storage::disk('public')->put('categoryphoto/'.$filename,$postfile);

        }
        else
        {
            $filename = $product->files;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        if(!Auth::guard('admin')->user()->role_id == 1)
        {
            $is_approved = false;
        }
        else
        {
            $is_approved = true;
        }

        // if(!$request->youtube_link)
        // {
        //     $youtube = null;
        // }
        // else
        // {
        //     $youtube = $request->youtube_link;
        // }

        // if(!$request->image)
        // {
        //     $featureimg = null;
        // }
        // else
        // {
        //     $featureimg = $imagename;
        // }

        $product->update([
            'title' => $request->title,
            'slug' => $slug,
            'admin_id' => Auth::id(),
            'unit' => $request->unit,
            'purchase_qty' => $request->purchase_qty,
            'low_stock_qty' => $request->low_stock_qty,
            'unit_price' => $request->unit_price,
            'discount_startdate' => $request->discount_startdate,
            'discount_enddate' => $request->discount_enddate,
            'discount_rate' => $request->discount_rate,
            'discount_type' => $request->discount_type,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'image' => $imagename,
            'youtube_link' => $request->youtube_link,
            'gallaryimage'=>  implode("|",$images),
            'files' => $filename,
            'desc' => $request->desc,
            'shipping' => $request->shipping,
            'cash_on_delivery' => $request->cash_on_delivery,
            'todays_deal' => $request->todays_deal,
            'estimate_shipping_time' => $request->estimate_shipping_time,
            'tax_type' => $request->tax_type,
            'tax' => $request->tax,
            'leftsidebar_id' => $request->leftsidebar_id,
            'rightsidebar_id' => $request->rightsidebar_id,
            'status' => $status,
            'is_approved' => $is_approved,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);

        //for many to many
        $product->productcategories()->sync($request->categories);


        notify()->success("Product Successfully Updated","Update");
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Gate::authorize('app.product.posts.destroy');

        $postphoto_path = public_path('uploads/productphoto/'.$product->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $gallaryimages = explode("|", $product->gallaryimage);

        foreach($gallaryimages as $gimage){

            $gallaryimage_path = public_path('uploads/productgallary_image/'.$gimage);

            if (file_exists($gallaryimage_path)) {

                @unlink($gallaryimage_path);

            }

        }

        $postfile_path = public_path('uploads/productfiles/'.$product->files);  // Value is not URL but directory file path
            if (file_exists($postfile_path)) {

                @unlink($postfile_path);

            }

        $product->productcategories()->detach();

        $product->delete();
        notify()->success('Product Deleted Successfully','Delete');
        return back();
    }
}
