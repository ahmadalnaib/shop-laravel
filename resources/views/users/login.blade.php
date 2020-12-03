@extends('layouts.app')

@section('content')
    <div class="w-25 mx-auto">
        @include('shared.errors')
        <form method="post" action="{{route('users.login')}}">
            @csrf

            <div class="form-group">
                <label for="email">البريد الالكتروني</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>

            </div>

            <div class="form-group">
                <label for="password">كلمة المرور</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>


            <button type="submit" class="btn btn-primary">login</button>
        </form>
    </div>

@endsection
