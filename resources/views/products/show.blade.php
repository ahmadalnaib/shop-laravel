@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <a href="/stores/{{$product->store->id}}">الرجوع الي {{$product->store->name}}</a>
        </div>
    </div>

    <div class="row">
        <div class="col-4 productImage">
            @isset($product->images)
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
               @foreach($product->images as $image)
                            <div class="carousel-item {{$loop->first ? 'active' :''}}">
                                <img src="{{$image}}" class="d-block w-100 " alt="...">
                            </div>
                @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                @endisset
                @empty($product->images)
                    <img src="{{asset('img/open.jpg')}}" alt="">
                @endempty
        </div>

        <div class="col-4">
            @include('shared.messages')
            <p class="font-weight-bold">اسم السلعه</p>
            <p class="lead">{{$product->name}}</p>
            <p class="font-weight-bold">سعر السلعه</p>
            <p class="lead">{{$product->price}}</p>

            @auth
            <form method="post"  action="{{route('orders.addProduct',$product->id)}}">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">الكمية</label>
                    <select name="quantity" class="form-control" id="exampleFormControlSelect1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <button type="submit" class="btn btn-primary mt-4">اضافه الئ الطلب</button>
                </div>
            </form>
            @endauth
        </div>
    </div>
@endsection
