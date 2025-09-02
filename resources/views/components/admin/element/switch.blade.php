@props([
'parentClass' => '',
'class' => '',
'id'=>null,
'name'=>'',
'type'=>'text',
'value'=>null,
'label'=>'',
'helperLabel'=>null,
'placeholder'=>'',
'required'=>0,
'minlength'=>0,
'maxlength'=>0,
'max'=>null,
'min'=>null,
'wireModel'=>null,
])


<label
    class="form-check form-switch form-check-custom form-check-solid {{$parentClass}} mb-3">
    <input class="form-check-input"
           type="checkbox"
{{--           value="{{$value??old($name)}}"--}}
           name="{{$name}}"
        {{ $attributes }}
    />
    <span class="form-check-label">{{$label}}</span>
</label>
