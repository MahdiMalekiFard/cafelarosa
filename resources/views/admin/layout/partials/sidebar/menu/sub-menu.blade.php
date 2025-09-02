@if($has_permission??true)
<div class="menu-item">
    <a
        @class([
            'menu-link',
            'active' => menuActive([$route],$exact??false),
            ])
        @conditionalNavigate(wire:navigate)
        href="{{$route}}">
        @if(is_null(@$sub) && @$icon)
            <span class="menu-icon">
                <i class="{{$icon}}"></i>
            </span>
        @else
            <span class="menu-bullet">
            <span class="bullet bullet-dot"></span>
        </span>
        @endif

        <span class="menu-title">{{$title}}</span>
    </a>
</div>
@endif