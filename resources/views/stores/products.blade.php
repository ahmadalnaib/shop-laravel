@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-4">
            @component('shared.sideBar',['stores'=>'active'])
            @endcomponent
        </div>

    <div class="col-8">
        <a href="{{route('products.create',$store->id)}}" class="btn btn-primary">اضافه سلعه</a>
        <div class="card-group">
            @foreach($store->products as $product)
                <div class="card" style="width:18rem;">
                    @isset($product->images[0])
                        <img src="{{asset($product->images[0])}}" class="card-img-top" alt="...">
                    @endisset

                    @empty($product->images[0])
                        <img src="{{asset('/img/open.jpg')}}" class="card-img-top" alt="...">
                    @endempty
                    <div class="card-body">
                        <h5 class="card-title">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
{{--                      <a href="{{route('product.edit',$product->id)}}" class="btn btn-primary">تعديل</a>--}}
{{--                       <a href="{{route('product.products',$product->id)}}" class="btn btn-primary">تعديل السلع</a>--}}
                    </div>
                </div>

            @endforeach
        </div>
    </div>

@endsection
