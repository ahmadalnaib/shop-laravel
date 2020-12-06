<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
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
    public function create(Store $store)
    {
         if($store->user_id !=auth()->user()->id)
         {
             return "انت لست صاحب المتجر";
         } else {
             return  view('products.create',compact('store'));
         }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Store $store)
    {
        if($store->user_id !=auth()->user()->id)
            return "انت لست صاحب المتجر";

        $validateData=request()->validate([
          'name'=>'required|min:2',
            'price'=>'required|min:1',
            'image1'=>'mimes:jpeg,bmp,png,jpg|max:3000',
            'image2'=>'mimes:jpeg,bmp,png,jpg|max:3000'
        ]);

        $path=array();

        if($request->hasFile('image1'))
            $path[]='/storage/'.$request->file('image1')->store('images',['disk'=>'public']);
        if($request->hasFile('image2'))
            $path[]='/storage/'.$request->file('image2')->store('images',['disk'=>'public']);

        $newProuct=new Product();
        $newProuct->name=$request->name;
        $newProuct->price=$request->price;
        $newProuct->images=$path;
        $store->products()->save($newProuct);

        return  redirect('/stores/'.$store->id.'/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product->store->user_id != auth()->user()->id)
            return  "انت لست مالك متحر الخاص بهذه السلعة";

        return  view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if($product->store->user_id !=auth()->user()->id)
            return "انت لست صاحب المتجر";

        $validateData=request()->validate([
            'name'=>'required|min:2',
            'price'=>'required|min:1',
            'image1'=>'mimes:jpeg,bmp,png,jpg|max:3000',
            'image2'=>'mimes:jpeg,bmp,png,jpg|max:3000'
        ]);

        $path=$product->images;

        if($request->hasFile('image1'))
            $path[0]='/storage/'.$request->file('image1')->store('images',['disk'=>'public']);
        if($request->hasFile('image2'))
            $path[1]='/storage/'.$request->file('image2')->store('images',['disk'=>'public']);


        $product->name=$request->name;
        $product->price=$request->price;
        $product->images=$path;
        $product->save();

        return  redirect('/stores/'.$product->store->id.'/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->store->user_id != auth()->user()->id)
            return 'انت لست المالك للمتجر الخاص بهذه السلعه';


        $product->delete();
        return redirect()->back();
    }
}
