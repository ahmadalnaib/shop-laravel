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
        $user=auth()->user();

        $total=0;
        foreach(session('currentOrders') as $product)
        {
            $total +=$product->price*$product->quantity;
        }

        if(empty(auth()->user()->address)){
            $message="ليس لديك عنوان لاكمل الطلب";
            return view('messages',compact('message'));
        }
        if(!session()->has('currentOrders'))
            return  "ليس لديك طلب مسبقا";

        return redirect($orderRepository->getChargeRequest($total,$user->name,$user->email,$user->password));
    }

    public  function  chargeUpdate(OrderRepository $orderRepository)
    {
      $response=$orderRepository->validateRequest(request()->tap_id);
      $newOrder=new Order();
      $newOrder->transaction_id=request()->tap_id;
      $newOrder->status=$response['status'];


      $products=session('currentOrders');
      $newOrder->user_id=auth()->user()->id;
      $newOrder->store_id=$products[0]->store_id;
      $newOrder->products=$products;
      $newOrder->payment_type='KNET';
      $newOrder->save();
      $status=$response["status"];
      return view('orders.paymentResult',compact('status'));


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=auth()->user()->orders;
        return  view('orders.index',compact('orders'));
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
        $total=0;
        foreach($order->products as $product)
        {
            $total += $product['quantity'] * $product['price'];
        }
        return  view('orders.show',compact('order','total'));
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

    public  function delivered(Order $order)
    {
      if($order->store->user->id != auth()->user()->id)
          return 'هذا المتجر ليس لك';

      if(!in_array($order->status,['paid','pending']))
          return  'لا يمكن تغير حاله الطلب';
      $order->status='delivered';
      $order->save();
      return redirect()->back();



    }
}
