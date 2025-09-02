@props([
    'form'=>'form',
    'backRoute'=>'',
    'submitText'=>trans('general.submit'),
    'backText'=>trans('general.back'),
    'alert'=>null
])
<div class="">
    <button type="submit" form="{{$form}}" class="btn btn-sm btn-primary">{{$submitText}}</button>
    @if($backRoute)
        <a href="{{$backRoute}}" @conditionalNavigate(wire:navigate) class="btn btn-sm btn-secondary">{{$backText}}</a>
    @endif
    @if($alert)
        <div id="{{$alert}}" style="display: inline-flex"></div>
    @endif
</div>