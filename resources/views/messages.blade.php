@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-12 text-center">
            <h3>{{$message}}</h3>
            <a href="{{route('home')}}" class="btn btn-primary">الصفحه الريئيسه</a>
        </div>
    </div>

@endsection
