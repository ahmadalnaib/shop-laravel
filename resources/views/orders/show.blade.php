@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-4">
          <ul class="list-group">
              <li class="list-group-item">معلومات الشخص</li>
              <li class="list-group-item list-group-item-primary">الاسم</li>
              <li class="list-group-item list-group-item-dark "> {{$order->user->name}}</li>
              <li class="list-group-item list-group-item-primary">الايميل</li>
              <li class="list-group-item list-group-item-dark"> {{$order->user->email}}</li>
              <li class="list-group-item list-group-item-primary">رقم الهاتف</li>
              <li class="list-group-item list-group-item-dark"> {{$order->user->number}}</li>
              <li class="list-group-item list-group-item-primary">المحافظه</li>
              <li class="list-group-item list-group-item-dark">  {{$order->user->address['area']}}</li>
              <li class="list-group-item list-group-item-primary">الشارع</li>
              <li class="list-group-item list-group-item-dark">  {{$order->user->address['street']}}</li>
              <li class="list-group-item list-group-item-primary">البيت</li>
              <li class="list-group-item list-group-item-dark">  {{$order->user->address['house']}}</li>
              <li class="list-group-item list-group-item-primary">ملاحظات</li>
              <li class="list-group-item list-group-item-dark">  {{$order->user->address['extra']}}</li>
          </ul>
        </div>
        <div class="col-8">
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

                        <td>{{$product['id']}}</td>
                        <td>{{$product['name']}}</td>
                        <td>{{$product['price']}}</td>
                        <td>{{$product['quantity']}}</td>
                    </tr>
                @endforeach
                <tr>
                    <td> السعر الكلي: {{$total}} </td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>

@endsection
