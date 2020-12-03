<div class="list-group">
    <a href="{{route('users.account')}}" class="list-group-item list-group-item-action {{$stores ?? ''}}">
        المتاجر
    </a>
    <a href="{{route('stores.create')}}" class="list-group-item list-group-item-action {{$create ?? ''}}">انشاء متجر جديد</a>
    <a href="#" class="list-group-item list-group-item-action">العنوان</a>
    <a href="#" class="list-group-item list-group-item-action">المعلومات الشخصية</a>

</div>
