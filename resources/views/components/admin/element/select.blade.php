@php use App\Enums\BooleanEnum;use App\Enums\GenderEnum;use App\Enums\NumberEnum;use App\Enums\StarEnum;use App\Enums\YesNoEnum;use App\Enums\CategoryTypeEnum;use App\Enums\ArtGalleryTypeEnum;@endphp
@props([
    'class'=>null,
    'parentClass'=>null,
    'label'=>null,
    'name'=>null,
    'type'=>null,
    'id'=>null,
    'value'=>null,
    'placeholder'=>__('general.please_select_an_option'),
    'helper'=>null,
    'helperLabel'=>null,
    'required'=>0,
    'solid'=>0,
    'options'=>null,
    'select2'=>0,
    'multiple'=>0,
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
    <select
        @if($name)
            name="{{$name}}"
        @endif
        @if($id)
            id="{{$id}}"
        @endif
        @class([
                'is-invalid'=>$errors->has($name),
                'form-control',
                'form-select',
                'form-control-solid'=>$solid,
                'select2-multiple'=>$multiple,
                $class
        ])
        {{$attributes}}
        @if($select2)
            data-control="select2" data-placeholder="{{$placeholder}}"
        @endif
        @if ($multiple)
            multiple="multiple"
        @endif
        value="{{$value}}"
        placeholder="{{$placeholder}}">
        @if($type === YesNoEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(YesNoEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === GenderEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(GenderEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === BooleanEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(BooleanEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === NumberEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(NumberEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === StarEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(StarEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === CategoryTypeEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(CategoryTypeEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($type === ArtGalleryTypeEnum::class)
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach(ArtGalleryTypeEnum::cases() as $case)
                <option value="{{$case->value}}" {{$case->value==$value?'selected':''}}>{{$case->title()}}</option>
            @endforeach
        @elseif($options)
            @foreach($options as $val=>$label)
                <option value="{{$val}}" {{$val==$value?'selected':''}}>{{$label}}</option>
            @endforeach
        @else
            @if($select2)
                <option></option>
            @endif
            {{$slot}}
        @endif

    </select>
</x-admin.element.form-group>
