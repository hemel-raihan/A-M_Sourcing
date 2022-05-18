<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|unique:subscribers'
        ]);

        $subscriber = Subscriber::create([
            'email' => $request->email
        ]);

        notify()->success("Successfully Subscribed","Added");
        return redirect()->route('home');
    }
}
