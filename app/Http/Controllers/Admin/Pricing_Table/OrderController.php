<?php

namespace App\Http\Controllers\Admin\Pricing_Table;

use App\Http\Controllers\Controller;
use App\Models\Package\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('price','address')->paginate(10);
        return view('backend.admin.pricing_table.order.orderlist',compact('orders'));
    }


    public function update_delivery_status(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        $order->update([
           'delivery_status' =>  $request->status,
        ]);

        // $order->delivery_status = $request->status;
        // $order->save();

        return 1;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {

    }

    public function all_orders_show($id)
    {
        $order_details = Order::findOrFail($id);
        return view('backend.admin.pricing_table.order.order_details', compact('order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
