@props([
'parentClass' => '',
'id'=>null,
'name'=>'tag_id[]',
'type'=>'text',
'label'=>'تگ ها',
'placeholder'=>'لطفا تگ مربوطه را به دقت انتخاب نمایید',
'required'=>0,
'multiple'=>1,
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
        @foreach($rows as $tag)
            @if (isset($selected))
                <option value="{{$tag}}" {{is_array($selected) && in_array($tag,$selected)?'selected':''}}>{{$tag}}</option>
            @else
                <option value="{{$tag}}" {{is_array(old($name)) && in_array($tag,old($name))?'selected':''}}>{{$tag}}</option>
            @endif
        @endforeach
    </select>
</x-admin.element.form-group>
