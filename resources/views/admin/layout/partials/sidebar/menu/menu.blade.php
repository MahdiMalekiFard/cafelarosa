@if($has_permission??true)
    <div data-kt-menu-trigger="click"
            @class([
               'menu-item',
               'menu-accordion' => isset($sub),
               'here show menu-accordion' => isset($sub) && parentMenuActive(collect($sub)->pluck('route')->toArray()),
        ])>
    <span class="menu-link">
        <span class="menu-icon"><i class="{{$icon}}"></i></span>
        <span class="menu-title">{{$title}}</span><span class="menu-arrow"></span>
    </span>
        <div class="menu-sub menu-sub-accordion">
            @foreach($sub??[] as $item)
                @include('admin.layout.partials.sidebar.menu.sub-menu',$item)
            @endforeach
        </div>
    </div>
@endif
