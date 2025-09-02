@props([
    'class'=>null,
    'parentClass'=>null,
    'label'=>null,
    'name'=>'',
    'type'=>'text',
    'id'=>null,
    'value'=>null,
    'placeholder'=>null,
    'helper'=>null,
    'helperLabel'=>null,
    'required'=>0,
    'solid'=>0,
    'minlength'=>0,
    'maxlength'=>0,
    'max'=>null,
    'min'=>null,
    'horizontal'=>false,
    'horizontal_label_cols'=>'col-lg-4 col-md-6 col-12',
    'horizontal_value_cols'=>'col-lg-8 col-md-6 col-12',

])
<x-admin.element.form-group
    :label="$label"
    :helper="$helper"
    :helperLabel="$helperLabel"
    :required="$required"
    :name="$name"
    :class="$parentClass"
    :horizontal="$horizontal"
    :horizontal_label_cols="$horizontal_label_cols"
    :horizontal_value_cols="$horizontal_value_cols"
>
    <input
        @if($name)
            name="{{$name}}"
        @endif
        @if($id)
            id="{{$id}}"
        @endif
        @class([
                'is-invalid'=>$errors->has($name),
                'form-control',
                'form-control-solid'=>$solid,
                $class
        ])
        @if (isset($required) && $required===1)
            required data-validation-required-message="این فیلد الزامی میباشد"
        @endif
        @if ($maxlength>0)
            maxlength="{{$maxlength}}" data-validation-maxlength-message="حداکثر تعداد کاراکتر {{$maxlength}} عدد میباشد"
        @endif
        @if ($minlength>0)
            minlength="{{$minlength}}" data-validation-minlength-message="حداقل تعداد کاراکتر {{$minlength}} عدد میباشد"
        @endif
        @if (isset($max))
            aria-valuemax="{{$max}}" data-validation-max-message="حداکثر مقدار {{$max}} میباشد"
        @endif
        @if (isset($min))
            aria-valuemin="{{$min}}" data-validation-min-message="حداکثر مقدار {{$min}} میباشد"
        @endif
        @if($type==='email')
            type="email"
            typeof="email"
        data-validation-email-message="لطفا ایمیل معتبر وارد کنید"
        @elseif($type=='price')
            type="text"
        data-validation-regex-regex="[0-9]+(\\.[0-9][0-9]?)?"
        data-validation-regex-message="لطفا مقدار صحیح وارد کنید"
        @elseif(!is_null($type))
            type="{{$type}}"
        @endif
        {{$attributes}}
        value="{{old($name,$value)}}"
        placeholder="{{$placeholder}}"/>
</x-admin.element.form-group>