@extends('layouts.app')

@section('content')
    <div class="w-25 mx-auto">
        @include('shared.errors')
    <form method="post" action="{{route('users.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">الاسم</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="email">البريد الالكتروني</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email">
            <small id="emailHelp" class="form-text text-muted">سوف لن نشارك معلوماتك مع طرف اخر</small>
        </div>

        <div class="form-group">
            <label for="password">كلمة المرور</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <label for="confirm"> تاكيد كلمة المرور</label>
            <input type="password" class="form-control" id="confirm" name="confirm">
        </div>

        <div class="form-group">
            <label for="number">الهاتف</label>
            <input type="number" class="form-control" id="number" name="number">
        </div>

        <button type="submit" class="btn btn-primary">تسجيل</button>
    </form>
    </div>
@endsection
