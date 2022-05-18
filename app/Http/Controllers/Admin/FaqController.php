<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::all();
        return view('backend.admin.faq.form',compact('faqs'));
    }

    public function fetchfaq()
    {
        $faqs = Faq::all();
        return response()->json([
            'faqs' => $faqs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.faq.pages.global');
        return view('backend.admin.faq.form');
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
            'title' => 'required|unique:faqs',
        ]);
        $slug = Str::slug($request->title);


        $faqs = Faq::create([
            'title' => $request->title,
            'slug' => $slug,
            'desc' => $request->desc,
        ]);

        // notify()->success("Tax Successfully created","Added");
        // return redirect()->route('admin.taxes.index');
        return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]
        );
    }


    public function status($id)
    {
        $faq = Faq::find($id);
        if($faq->status == true)
        {
            $faq->status = false;
            $faq->save();

            return response()->json(
                [
                    'status' => 200,
                ]
            );
        }
        elseif($faq->status == false)
        {
            $faq->status = true;
            $faq->save();

            return response()->json(
                [
                    'status' => 200,
                ]
            );
        }

        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        $faqq = Faq::find($faq);
        if($faqq)
        {
            return response()->json(
                [
                    'status' => 200,
                    'faqq' => $faqq,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Faq Not Found'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $faqq = Faq::find($request->id);
        $slug = Str::slug($request->title);
        $faqq->update([
            'title' => $request->title,
            'slug' => $slug,
            'desc' => $request->desc,
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Data Updated successfully'
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        notify()->success('Faq Deleted Successfully','Delete');
        return back();
    }
}
