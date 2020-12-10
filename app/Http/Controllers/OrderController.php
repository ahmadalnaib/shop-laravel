<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{



    public function chargeRequest(OrderRepository $orderRepository)
    {
        return redirect($orderRepository->getChargeRequest('1','2','3','4'));
    }

    public  function  chargeUpdate()
    {
        return request();
    }
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
        if(!session()->has('currentOrders'))
        return redirect()->route('home');

        $total=0;
        foreach(session('currentOrders') as $product)
        {
            $total+=$product->price*$product->quantity;
        }
        return  view('orders.create',compact('total'));
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public  function addProduct(Product $product)
    {

        $validateData=request()->validate([
           'quantity'=>'required|integer|min:1'
        ]);
        $currentOrders=session()->has('currentOrders') ? session('currentOrders') : array();
        if(!empty($currentOrders))
        {
            if($currentOrders[0]->store_id != $product->store_id)
                $currentOrders=array();
        }

        $alreadyExist=false;
        foreach ($currentOrders as $order)
        {
            if($order->id == $product->id)
            {
        $alreadyExist=true;
        $order->quantity +=request()->quantity;
            }
        }

        if(!$alreadyExist)
        {
            $product->quantity=request()->quantity;
            $currentOrders[]=$product;

        }

       session(['currentOrders'=>$currentOrders]);
       return back()->with('messages',[ 'تم اضافه السلعه بنجاح'
           . $product->name
           .  " بكميه"  .
            request()->quantity
       ]);
    }
}
