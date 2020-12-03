@extends('layouts.app')

@section('content')
    <div class="card-deck">
    @foreach($stores as $store)
    <div class="card" style="width: 18rem;">
        @empty($store->image)
        <img src="{{asset('/img/open.jpg')}}" class="card-img-top" alt="...">
        @endempty
        <div class="card-body">
            <h5 class="card-title">{{$store->name}}</h5>
            <p class="card-text">{{$store->description}}</p>
            <a href="#" class="btn btn-primary">تعديل</a>
        </div>
    </div>

    @endforeach
    </div>
@endsection
