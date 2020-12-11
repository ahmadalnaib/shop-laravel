@extends('layouts.app')


@section('content')

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">المتجر</th>
                    <th scope="col">رقم الطلب</th>
                    <th scope="col">الدفع</th>
                    <th scope="col">الحاله</th>
                    <th scope="col">السلع</th>
                    <th scope="col">اجراءات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->store->name}}</td>
                        <td>{{$order->transaction_id}}</td>
                        <td>{{$order->payment_type}}</td>
                        <td>{{$order->status}}</td>
                        <td>{{sizeof($order->products)}}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{route('orders.store',$order->id)}}">التفاصيل</a>
                            @if($order->status=='paid')
                                <a class="btn btn-sm btn-primary" href="{{route('orders.delivered',$order->id)}}">تم التوصيل</a>
                                @endif
                        </td>

                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>

@endsection
