@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-4">
            @component('shared.sideBar',['create'=>'active'])
            @endcomponent
        </div>

        <div class="col-4">
            @include('shared.errors')
            <h5>نموذج تعديل سلعة</h5>
            <form method="post" action="{{route('products.update',$product->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">اسم السلعة</label>
                    <input type="text" class="form-control" id="name" value="{{$product->name}}" aria-describedby="nameHelp" name="name" required>
                </div>

                <div class="form-group">
                    <label for="price">السعر</label>
                    <input type="text" class="form-control" id="price" value="{{$product->price}}" aria-describedby="priceHelp" name="price" required>
                </div>

                <div class="form-group">
                    <label for="image1">صور السلعة</label>
                    <input type="file" class="form-control-file" id="image1" name="image1">
                    <input type="file" class="form-control-file" id="image2" name="image2">
                </div>



                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    </div>
@endsection
