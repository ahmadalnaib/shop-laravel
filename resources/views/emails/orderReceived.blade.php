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
            @foreach($order->products as $product)
            <tr>
                <th scope="row">{{$product['id']}}</th>
                <td>{{$product['name']}}</td>
                <td>{{$product['price']}}</td>
                <td>{{$product['quantity']}}</td>
            </tr>
            @endforeach
            <tr>
{{--                <td> السعر الكلي: {{$total}} </td>--}}
            </tr>
            </tbody>
        </table>

    </div>
</div>

@endsection
