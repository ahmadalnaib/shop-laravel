<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
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
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedDate=$request->validate([
          'name'=>'required|min:2',
            'description'=>'required|min:5',
            'image'=>'mimes:jpeg,png,bmp,jpg|max:3000'
        ]);
        $path=null;
        if($request->hasFile('image'))
        $path='/storage/'.$request->file('image')->store('logos',['disk'=>'public']);

        $newStore=new Store();
        $newStore->name=$request->name;
        $newStore->description=$request->description;
        $newStore->image=$path;

        auth()->user()->stores()->save($newStore);
        return  redirect()->route('users.account');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return view('stores.show',compact('store'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        if($store->user_id != auth()->user()->id){
            return  "انت لست المالك";
        }
        return view('stores.edit',compact('store'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        $validatedDate=$request->validate([
            'name'=>'required|min:2',
            'description'=>'required|min:5',
            'image'=>'mimes:jpeg,png,bmp,jpg|max:3000'
        ]);
             $path=$store->image;
            if($request->hasFile('image'))
            $path='/storage/'.$request->file('image')->store('logos',['disk'=>'public']);

            $store->name=$request->name;
            $store->description=$request->description;
            $store->image=$path;
            $store->save();

            return  redirect()->route('users.account');
    }


    public  function products(Request $request, Store $store)
    {


        if($store->user_id != auth()->user()->id){
            return  "انت لست المالك";
        }
        return view('stores.products',compact('store'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        if ($store->user_id != auth()->user()->id)
            return "انت لست المالك";

        $store->delete();
        return redirect()->back();
    }

    public function orders()
    {
        $stores=auth()->user()->stores;
        $orders=[];
        foreach ($stores as $store)
        {

               foreach ($store->orders as $order)
               {
                   $orders[]=$order;
               }
        }
         return view('stores.orders',compact('orders'));
    }

}
