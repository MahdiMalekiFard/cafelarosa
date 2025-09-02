@props([
'parentClass' => '',
'class' => '',
'id'=>null,
'name'=>'',
'type'=>'text',
'value'=>null,
'label'=>'',
'placeholder'=>'',
'required'=>0,
'minlength'=>0,
'maxlength'=>0,
])


<x-admin.element.form-group
    :class="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
>

    <textarea type="{{$type}}"
              @if (isset($id))
                  id="{{$id}}"
              @endif
              @if (isset($required) && $required==true)
                  required data-validation-required-message="این فیلد الزامی میباشد"
              @endif
              @if ($maxlength>0)
                  maxlength="{{$maxlength}}" data-validation-maxlength-message="حداکثر تعداد کاراکتر {{$maxlength}} عدد میباشد"
              @endif
              @if ($minlength>0)
                  minlength="{{$minlength}}" data-validation-minlength-message="حداقل تعداد کاراکتر {{$minlength}} عدد میباشد"
              @endif
              placeholder="{{$placeholder}}"
              {{ $attributes }}
              {{ $attributes->merge(['class' => 'form-control ' . $class]) }}
              rows="3"
              name="{{$name}}">{{$value??old($name)}}</textarea>
</x-admin.element.form-group>
