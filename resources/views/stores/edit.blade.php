@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-4">
            @component('shared.sideBar',['create'=>'active'])
            @endcomponent
        </div>

        <div class="col-4">
            @include('shared.errors')
            <h5>نموذج تعديل متجر</h5>
            <form method="post" action="{{route('stores.update',$store->id)}}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">اسم المتجر</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name" value="{{$store->name}}" required>
                </div>

                <div class="form-group">
                    <label for="description">الوصف</label>
                    <input type="text" class="form-control" id="description" value="{{$store->description}}" aria-describedby="nameHelp" name="description" required>
                </div>

                <div class="form-group">
                    <label for="image">صورة المتجر</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>



                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    </div>
@endsection
