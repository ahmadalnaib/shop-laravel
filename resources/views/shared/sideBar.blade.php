<div class="list-group">
    <a href="{{route('users.account')}}" class="list-group-item list-group-item-action {{$stores ?? ''}}">
        المتاجر
    </a>
    <a href="{{route('stores.create')}}" class="list-group-item list-group-item-action {{$create ?? ''}}">انشاء متجر جديد</a>
    @if(sizeof(auth()->user()->stores)>0)
    <a href="{{route('stores.orders')}}" class="list-group-item list-group-item-action {{$storesOrders ?? ''}}">طلبات المتاجر</a>
    @endif
    <a href="{{route('users.address')}}" class="list-group-item list-group-item-action {{$address ?? ''}}">العنوان</a>
    <a href="{{route('users.edit')}}" class="list-group-item list-group-item-action {{$edit ?? ''}}">المعلومات الشخصية</a>

</div>
