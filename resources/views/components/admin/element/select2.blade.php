@props([
'parentClass' => '',
'id'=>null,
'name'=>'category_id',
'type'=>'text',
'label'=>'',
'placeholder'=>'لطفا گزینه مربوطه را انتخاب نمایید',
'required'=>0,
'multiple'=>0,
])

<x-admin.element.form-group
    :parentClass="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
>
    <select name="{{$name}}"
            @if (isset($id))
                id="{{$id}}"
            @endif
            @if ($multiple)
                multiple="multiple"
            @endif
            @if (isset($required) && $required==true)
                required data-validation-required-message="این فیلد الزامی میباشد"
            @endif
            {{ $attributes }}
            class="form-select"
            data-placeholder="{{$placeholder}}"
            data-control="select2">
        <option></option>
        {{$slot}}
    </select>
</x-admin.element.form-group>
