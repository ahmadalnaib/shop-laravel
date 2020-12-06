@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-4">
            @component('shared.sideBar',['edit'=>'active'])
            @endcomponent
        </div>

        <div class="col-4">
            @include('shared.errors')
            <h5>نموذج تعديل المعلومات </h5>
            <form method="post" action="{{route('users.edit')}}">
                @csrf


                <div class="form-group">
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="{{$user->email}}">
                    <small id="emailHelp" class="form-text text-muted">سوف لن نشارك معلوماتك مع طرف اخر</small>
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <label for="confirm"> تاكيد كلمة المرور</label>
                    <input type="password" class="form-control" id="confirm" name="confirm">
                </div>

                <div class="form-group">
                    <label for="number">الهاتف</label>
                    <input type="number" class="form-control" id="number" name="number" value="{{$user->number}}">
                </div>

                <button type="submit" class="btn btn-primary">تعديل</button>
            </form>
        </div>
    </div>
@endsection
