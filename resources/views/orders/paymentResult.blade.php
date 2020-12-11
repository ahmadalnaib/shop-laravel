@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-12">
            @if($status =='CAPTURED')
              <p>استلمنا طلبك سنواصل معك</p>
            @else
            <p>طلبك لم ينجح
                <a href="{{route('orders.create')}}">حاول مره اخرئ</a>

            </p>
                @endif
        </div>
    </div>

@endsection
