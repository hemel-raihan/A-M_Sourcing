<?php

namespace App\Http\Controllers\Admin\Client;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('backend.admin.client.index',compact('clients'));
    }

    // public function fetchclient()
    // {
    //     $clients = Client::all();
    //     return response()->json([
    //         'categories' => $clients,
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.client.form');
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
            'name' => 'required|unique:clients',
        ]);

         //get form image
         $image = $request->file('logo');
         $slug = Str::slug($request->name);
         if(isset($image))
         {
             $currentDate = Carbon::now()->toDateString();
             $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

             $clientphotoPath = public_path('uploads/clientlogo');
             $img                     =       Image::make($image->path());
             $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($clientphotoPath.'/'.$imagename);
             //$img->resize(900, 600)->save($categoryphotoPath.'/'.$imagename);

         }
         else
         {
             $imagename = null;
         }

        $client = Client::create([
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $imagename,
            'website' => $request->website,
        ]);

        notify()->success("Client Successfully created","Added");
        return redirect()->route('admin.clients.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('backend.admin.client.form',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {


        //get form image
        $image = $request->file('logo');
        $slug = Str::slug($request->name);

        if(isset($image))
        {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            $clientphotoPath = public_path('uploads/clientlogo');

            $clientphoto_path = public_path('uploads/clientlogo/'.$client->logo);  // Value is not URL but directory file path
            if (file_exists($clientphoto_path)) {

                @unlink($clientphoto_path);

            }

            $img                     =       Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($clientphotoPath.'/'.$imagename);

        }
        else
        {
            $imagename = $client->logo;
        }


        $client->update([
            'name' => $request->name,
            'slug' => $slug,
            'logo' => $imagename,
            'website' => $request->website,
        ]);

        notify()->success("Client Successfully Updated","Update");
        return redirect()->route('admin.clients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        notify()->success('Category Deleted Successfully','Delete');
        return back();
    }
}
