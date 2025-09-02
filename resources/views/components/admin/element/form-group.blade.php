@props([
    'class'=>null,
    'label'=>null,
    'name'=>null,
    'required'=>0,
    'helper'=>null,
    'helperLabel'=>null,
    'horizontal'=>false,
    'horizontal_label_cols'=>'col-lg-3 col-md-4 col-12',
    'horizontal_value_cols'=>'col-lg-9 col-md-8 col-12',
])
<div
        @class([
            'd-flex'=>!$horizontal,
            'flex-column'=>!$horizontal,
            'mb-8',
            'fv-row',
            'control-group',
            'has-validation'=>$errors->has($name),
            'row'=>$horizontal,
            $class
    ])>
    <div @class(['controls m-0 p-0','row'=>$horizontal])>
        <label @class([
        'd-flex align-items-center fs-6 fw-semibold mb-2 control-label'=>!$horizontal,
        'col-form-label fw-semibold fs-6'=>$horizontal,
        $horizontal_label_cols=>$horizontal,
])>
        <span @class([ 'required'=>$required ])  >
            {{$label}}
            @if($helperLabel)
                <small class="text-danger fw-bold">({{$helperLabel}})</small>
            @endif
        </span>

            @if($helper)
                <span class="ms-1" data-bs-toggle="tooltip" title="{{$helper}}">
                <i class="ki-duotone ki-information-5 text-gray-500 fs-6"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
            </span>
            @endif
        </label>
        @if($horizontal)
            <div class="{{$horizontal_value_cols}} fv-row">
                {{$slot}}
            </div>
        @else
            {{$slot}}
        @endif


        @error($name)
        <small class="form-control-feedback text-danger">{{$message}}</small>
        @enderror
    </div>
</div>