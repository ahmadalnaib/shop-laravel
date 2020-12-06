@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-group">
                @foreach( $stores as $store)
                    <div class="card" style="width:18rem;">
                        @isset($store->image)
                            <img src="{{asset($store->image)}}" class="card-img-top" alt="...">
                        @endisset

                        @empty($store->image)
                            <img src="{{asset('/img/open.jpg')}}" class="card-img-top" alt="...">
                        @endempty
                        <div class="card-body">
                            <h5 class="card-title">{{$store->name}}</h5>
                            <p class="card-text">{{$store->description}}</p>
                           <a role="button" href="{{route('stores.show',$store->id)}}" class="btn btn-primary">زيارة</a>

                        </div>
                    </div>

                @endforeach
          <div class="pagin">  {!! $stores->links() !!}</div>
        </div>
    </div>

@endsection

