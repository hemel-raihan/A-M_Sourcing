<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallaryimage;
use Illuminate\Http\Request;

class GalleryimageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallaryimage  $gallaryimage
     * @return \Illuminate\Http\Response
     */
    public function show(Gallaryimage $gallaryimage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallaryimage  $gallaryimage
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallaryimage $gallaryimage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallaryimage  $gallaryimage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallaryimage $gallaryimage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallaryimage  $gallaryimage
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Gallaryimage $gallaryimage, $id,$key)
    // {
    //     $galleryimg = Gallaryimage::find($id);

    //     $imagee = explode("|",$galleryimg->image);
    //     return $imagee;
    // }

    // public function deletee( $id,$key)
    // {
    //     $galleryimg = Gallaryimage::find($id);

    //     $test = json_decode($galleryimg->image);
    //      $test[0]->delete();



    //     //  $imagee = explode("|",$galleryimg->image);
    //     // foreach($imagee as $onno => $img)
    //     // {
    //     //     if($onno == $key)
    //     //     {

    //     //         $galleryimg->image = str_replace($img,'', $imagee);
    //     //         return  $galleryimg->image = implode("|",$galleryimg->image);

    //     //         $galleryimg->save();
    //     //     }

    //     // }

    // }
}
