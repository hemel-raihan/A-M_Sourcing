<?php

namespace App\Http\Controllers\Admin;

use App\Models\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::all();
        return view('backend.admin.counter.form',compact('counters'));
    }

    public function fetchcounter()
    {
        $counters = Counter::all();
        return response()->json([
            'counters' => $counters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('app.counter.pages.global');
        return view('backend.admin.counter.form');
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
            'title' => 'required|unique:counters',
        ]);


        $counters = Counter::create([
            'title' => $request->title,
            'number' => $request->number,
            'color' => $request->color,
            'icon' => $request->icon,
            'extra_text' => $request->extra_text,
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function show(Counter $counter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        $counterss = Counter::find($counter);
        if($counterss)
        {
            return response()->json(
                [
                    'status' => 200,
                    'counterss' => $counterss,
                ]
            );
        }
        else
        {
            return response()->json(
                [
                    'status' => 404,
                    'message' => 'Counter Not Found'
                ]
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Counter $counter)
    {
        $counterss = Counter::find($request->id);

        $counterss->update([
            'title' => $request->title,
            'number' => $request->number,
            'color' => $request->color,
            'icon' => $request->icon,
            'extra_text' => $request->extra_text,
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
     * @param  \App\Models\Counter  $counter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        notify()->success('Faq Deleted Successfully','Delete');
        return back();
    }
}
