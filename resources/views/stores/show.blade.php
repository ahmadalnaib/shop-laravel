@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-group">
                @foreach( $store->products as $product)
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
                            <a role="button" href="{{route('products.show',$product->id)}}" class="btn btn-primary">عرض</a>

                        </div>
                    </div>

                @endforeach

            </div>
        </div>

@endsection

