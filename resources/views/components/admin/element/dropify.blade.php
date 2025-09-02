@props([
'parentClass' => '',
'id'=>null,
'name'=>'image',
'type'=>'file',
'label'=>'',
'helperLabel'=>null,
'required'=>0,
'domReRenderingByLivewire'=>1,
'showRemoveButton'=>1,
'wireModel'=>'',
'default'=>'',
'size'=>'2M',
'resolution'=>'1280*720',
'extensions'=>'png jpg jpeg',
'messages_default'=>__('core.dropify.messages.default'),
'messages_replace'=>__('core.dropify.messages.replace'),
'messages_remove'=>__('core.dropify.messages.remove'),
'messages_error'=>__('core.dropify.messages.error'),
'horizontal'=>false,
'horizontal_label_cols'=>'col-lg-4 col-md-6 col-12',
'horizontal_value_cols'=>'col-lg-8 col-md-6 col-12',
])

@once
    @push('css')
        <link href="/assets/plugins/custom/dropify/dropify.min.css" rel="stylesheet" type="text/css"/>
    @endpush
    @if (!$showRemoveButton)
        @push('css')
            <style>
                .dropify-wrapper .dropify-clear {
                    display: none !important;
                }
            </style>
        @endpush
    @endif
    @push('js')
        <script src="/assets/plugins/custom/dropify/dropify.min.js" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function () {
                $('.dropify').dropify({
                    messages: {
                        default: '{{$messages_default}}',
                        replace: '{{$messages_replace}}',
                        remove: '{{$messages_remove}}',
                        error: '{{$messages_error}}'
                    }
                });
            });
        </script>
    @endpush
@endonce

<x-admin.element.form-group
        :class="$parentClass"
        :name="$name"
        :required="$required"
        :label="$label"
        :helperLabel="$helperLabel"
        :horizontal="$horizontal"
        :horizontal_label_cols="$horizontal_label_cols"
        :horizontal_value_cols="$horizontal_value_cols"
>
    @if(!$domReRenderingByLivewire)
        <div wire:ignore>
            <input type="{{$type}}"
                   @if (isset($id))
                       id="{{$id}}"
                   @endif
                   @if (isset($required) && $required==true)
                       required data-validation-required-message="این فیلد الزامی میباشد"
                   @endif
                   data-default-file="{{$default}}"
                   data-allowed-file-extensions="{{$extensions}}"
                   data-max-file-size-preview="{{$size}}"
                   class="form-control dropify"
                   @if(isset($wireModel))
                       wire:model="{{ $wireModel }}"
                   @endif
                   {{ $attributes }}
                   name="{{$name}}">
        </div>
    @else
        <input type="{{$type}}"
               @if (isset($id))
                   id="{{$id}}"
               @endif
               @if (isset($required) && $required==true)
                   required data-validation-required-message="این فیلد الزامی میباشد"
               @endif
               data-default-file="{{$default}}"
               data-allowed-file-extensions="{{$extensions}}"
               data-max-file-size-preview="{{$size}}"
               class="form-control dropify"
               @if(isset($wireModel))
                   wire:model="{{ $wireModel }}"
               @endif
               {{ $attributes }}
               name="{{$name}}">
    @endif

</x-admin.element.form-group>
