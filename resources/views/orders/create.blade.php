@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">السلعه</th>
                    <th scope="col">السعر</th>
                    <th scope="col">الكمية</th>
                </tr>
                </thead>
                <tbody>
                @foreach(session('currentOrders') as $product)
                <tr>
                    <th scope="row">{{$product->id}}</th>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                </tr>
                @endforeach
                    <tr>
                        <td> السعر الكلي: {{$total}} </td>
                    </tr>
                </tbody>
            </table>
                <a class="btn btn-primary m-2" href="{{route('home')}}">اكمل التسوق
                <a class="btn btn-primary " href="{{route('orders.chargeRequest')}}">الدفع</a>
        </div>
    </div>

@endsection
