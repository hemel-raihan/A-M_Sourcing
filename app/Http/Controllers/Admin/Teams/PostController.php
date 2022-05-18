<?php

namespace App\Http\Controllers\Admin\Teams;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Teams\Teampost;
use App\Models\Teams\Teamcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('app.team.posts.self');
        $auth = Auth::guard('admin')->user();
        $posts = Teampost::with('teamcategories')->latest()->paginate(5);
        return view('backend.admin.team.post.index',compact('posts','auth'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.team.posts.create');
        $categories = Teamcategory::with('childrenRecursive')->where('parent_id', '=', 0)->get();
        $subcat = Teamcategory::all();
        return view('backend.admin.team.post.form',compact('categories','subcat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('app.team.posts.create');
            $this->validate($request,[
                'name' => 'required',
                'designation' => 'required',
                'image' => 'required|max:1024',
                'categories' => 'required',
            ]);


        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/teamphoto');
            $img                     =       Image::make($image->path());
            $img->resize(250, 280)->save($postphotoPath.'/'.$imagename);
            // $img->resize(250, 300, function ($constraint) {
            //         $constraint->aspectRatio();
            //     })->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = null;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }



        $post = Teampost::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'slug' => $slug,
            'image' => $imagename,
            'status' => $status,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin

        ]);

        //for many to many
        $post->teamcategories()->attach($request->categories);


        notify()->success("Post Successfully created","Added");
        return redirect()->route('admin.teamposts.index');
    }


    public function status_approval($id)
    {
        Gate::authorize('app.team.posts.status');
        $post = Teampost::find($id);
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
     * @param  \App\Models\Teams\Teampost  $teampost
     * @return \Illuminate\Http\Response
     */
    public function show(Teampost $teampost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teams\Teampost  $teampost
     * @return \Illuminate\Http\Response
     */
    public function edit(Teampost $teampost)
    {
        Gate::authorize('app.team.posts.edit');
        $categories = Teamcategory::with('childrenRecursive')->where('parent_id', '=', 0)->get();
        $subcat = Teamcategory::all();
        return view('backend.admin.team.post.form',compact('teampost','categories','subcat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teams\Teampost  $teampost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teampost $teampost)
    {
        Gate::authorize('app.team.posts.edit');
        $this->validate($request,[
            'name' => 'required',
            'image' => 'max:1024',
            'categories' => 'required',
        ]);

        //get form image
        $image = $request->file('image');
        $slug = Str::slug($request->title);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $postphotoPath = public_path('uploads/teamphoto');

            $postphoto_path = public_path('uploads/teamphoto/'.$teampost->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

           $img                     =       Image::make($image->path());
           $img->resize(250, 280)->save($postphotoPath.'/'.$imagename);
        //    $img->resize(150, 300, function ($constraint) {
        //     $constraint->aspectRatio();
        //     })->save($postphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $teampost->image;
        }

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $teampost->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'image' => $imagename,
            'body' => $request->body,
            'status' => $status,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin

        ]);

        //for many to many
        $teampost->teamcategories()->sync($request->categories);


        notify()->success("Post Successfully Updated","Update");
        return redirect()->route('admin.teamposts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teams\Teampost  $teampost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teampost $teampost)
    {
        Gate::authorize('app.team.posts.destroy');
        // //delete old image
        // if(Storage::disk('public')->exists('postphoto/'.$post->image))
        // {
        //     Storage::disk('public')->delete('postphoto/'.$post->image);
        // }

        $postphoto_path = public_path('uploads/teamphoto/'.$teampost->image);  // Value is not URL but directory file path
            if (file_exists($postphoto_path)) {

                @unlink($postphoto_path);

            }

        $teampost->teamcategories()->detach();

        $teampost->delete();
        notify()->success('Post Deleted Successfully','Delete');
        return back();
    }
}
