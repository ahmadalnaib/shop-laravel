@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-4">
            @component('shared.sideBar',['address'=>'active'])
            @endcomponent
        </div>

        <div class="col-4">
            @include('shared.errors')
            <h5>نموذج تعديل العنوان</h5>
            <form method="post" action="{{route('users.storeAddress')}}">
                @csrf
                <div class="form-group">
                    <label for="area">المنطقه</label>
                    <input type="text"  class="form-control" id="area" aria-describedby="areaHelp" name="area" value="{{$address['area']}}" required>
                </div>
                <div class="form-group">
                    <label for="block">القظعه</label>
                    <input type="text"  class="form-control" id="block" aria-describedby="blockHelp" name="block" value="{{$address['block']}}" required>
                </div>
                <div class="form-group">
                    <label for="street">الشارع</label>
                    <input type="text"  class="form-control" id="street" aria-describedby="streetHelp" name="street" value="{{$address['street']}}" required>
                </div>
                <div class="form-group">
                    <label for="house">البيت</label>
                    <input type="text"  class="form-control" id="house" aria-describedby="houseHelp" name="house" value="{{$address['house']}}" required>
                </div>

                <div class="form-group">
                    <label for="extra">معلومات اضافيه</label>
                    <input type="text"  class="form-control" id="extra" aria-describedby="extraHelp" name="extra" value="{{$address['extra']}}" required>
                </div>





                <button type="submit" class="btn btn-primary">انشاء</button>
            </form>
        </div>
    </div>
@endsection
