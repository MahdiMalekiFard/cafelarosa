@props([
'parentClass' => '',
'class' => '',
'id'=>null,
'name'=>'',
'type'=>'text',
'value'=>null,
'label'=>'',
'helperLabel'=>null,
'required'=>0,
'selected'=>0,
])


<label
        {{ $attributes->merge(['class' => 'form-check form-check-custom form-check-solid ' . $class]) }}>
    <input class="form-check-input"
           type="checkbox"
           value="{{$value}}"
           name="{{$name}}"
           @if($selected) checked @endif
            {{ $attributes }}/>
    <span class="form-check-label">{{$label}}</span>
</label>
