<?php

namespace App\Http\Controllers\Admin\Career;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Career\Jobpost;
use App\Models\Career\Jobcategory;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $jobs = Jobpost::with('jobcategory')->latest()->paginate(5);
        // $jobs = Jobpost::paginate(5);
        return view('backend.admin.career.job.index',compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Jobcategory::all();
        return view('backend.admin.career.job.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|unique:jobposts',
            'categories' => 'required',
        ]);


        $slug = Str::slug($request->title);

        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $job = Jobpost::create([
            'jobcategory_id' => $request->categories,
            'title' => $request->title,
            'slug' => $slug,
            'employement_status' => $request->employement_status,
            'vacancy' => $request->vacancy,
            'application_deadline' => $request->application_deadline,
            'exp_in_year' => $request->exp_in_year,
            'body' => $request->body,
            'email' => $request->email,
            'read_before' => $request->read_before,
            'status' => $status,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,

        ]);


        notify()->success("Job Successfully created","Added");
        return redirect()->route('admin.jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Career\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function show(Jobpost $jobpost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Career\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function edit(Jobpost $job)
    {
        $categories = Jobcategory::all();
        return view('backend.admin.career.job.form',compact('job','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Career\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jobpost $job)
    {
        $this->validate($request,[
            'title' => 'required',
            'categories' => 'required',
        ]);


        $slug = Str::slug($request->title);


        if(!$request->status)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }


        $job->update([
            'jobcategory_id' => $request->categories,
            'title' => $request->title,
            'slug' => $slug,
            'employement_status' => $request->employement_status,
            'vacancy' => $request->vacancy,
            'application_deadline' => $request->application_deadline,
            'exp_in_year' => $request->exp_in_year,
            'body' => $request->body,
            'email' => $request->email,
            'read_before' => $request->read_before,
            'status' => $status,
            'meta_title' => $request->meta_title,
            'meta_desc' => $request->meta_desc,
        ]);

        notify()->success("Job Successfully Updated","Update");
        return redirect()->route('admin.jobs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Career\Jobpost  $jobpost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jobpost $job)
    {
        $job->delete();

        notify()->success('Job Deleted Successfully','Delete');
        return back();
    }
}
