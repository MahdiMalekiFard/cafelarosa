@props([
'parentClass' => '',
'id'=>'mymce',
'name'=>'body',
'type'=>'create',
'value'=>null,
'label'=>'توضیحات کامل',
'placeholder'=>'',
'required'=>0,
'minlength'=>0,
'maxlength'=>0,
])
@push('js')
    <script src="/assets/plugins/custom/tinymce/tinymce.bundle.js"></script>
    @if(isRtl())
        <script src="/assets/plugins/custom/tinymce/tinymce_init.js"></script>
    @else
        <script src="/assets/plugins/custom/tinymce/tinymce_init_en.js"></script>
    @endif
@endpush
@props([
'parentClass' => '',
'id'=>'mymce',
'name'=>'body',
'type'=>'create',
'value'=>null,
'label'=>'توضیحات کامل',
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
        <textarea
            class="form-control mymce"
            @if (isset($required) && $required==true)
                required data-validation-required-message="این فیلد الزامی میباشد"
            @endif
            @if ($maxlength>0)
                maxlength="{{$maxlength}}" data-validation-maxlength-message="حداکثر تعداد کاراکتر {{$maxlength}} عدد میباشد"
            @endif
            @if ($minlength>0)
                minlength="{{$minlength}}" data-validation-minlength-message="حداقل تعداد کاراکتر {{$minlength}} عدد میباشد"
            @endif
            id="{{$id}}"
            {{ $attributes }}
            name="{{$name}}">
            @if ($type=='edit')
                {!! @$value !!}
            @else
                {!! old($name) !!}
            @endif
</textarea>
</x-admin.element.form-group>
