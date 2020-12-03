@extends('layouts.app')

@section('content')
    <div class="row">

    <div class="col-4">
        @component('shared.sideBar',['create'=>'active'])
        @endcomponent
    </div>

    <div class="col-4">
            @include('shared.errors')
        <h5>نموذج انشاء متجر</h5>
            <form method="post" action="{{route('stores.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">اسم المتجر</label>
                    <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name" required>
                </div>

                <div class="form-group">
                    <label for="description">الوصف</label>
                    <input type="text" class="form-control" id="description" aria-describedby="nameHelp" name="description" required>
                </div>

                <div class="form-group">
                    <label for="image">صورة المتجر</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>



                <button type="submit" class="btn btn-primary">انشاء</button>
            </form>
        </div>
    </div>
@endsection
