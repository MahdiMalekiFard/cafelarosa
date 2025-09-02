@props([
'parentClass' => '',
'class' => '',
'id'=>'datepicker_'.rand(1000,9999),
'name'=>'',
'value'=>null,
'label'=>'',
'helperLabel'=>null,
'placeholder'=>'',
'required'=>0,
'wireModel'=>null,
'format'=>'YYYY/MM/DD',
'initialValue'=>0,
'initialValueType'=>'gregorian', //persian - gregorian
'autoClose'=>1,
'minDate'=>null,
'maxDate'=>null,
])
@once
    @push('js')
        <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@latest/dist/css/persian-datepicker.min.css">
        <script src="https://unpkg.com/persian-date@latest/dist/persian-date.min.js"></script>
        <script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>
        <script>
            Livewire.hook('message.processed', (message, component) => {
                initDatePicker()
            })
        </script>
    @endpush
@endonce
@push('js')
    <script>
        function initDatePicker() {
            $("#{{$id}}").persianDatepicker({
                calendarType: 'persian',
                format: '{{$format}}',
                initialValue: {{$initialValue}},
                observer: true,
                initialValueType: '{{$initialValueType}}',
                autoClose: {{$autoClose}},
                @if($minDate)
                minDate: '{{$minDate}}',
                @endif
                    @if($maxDate)
                maxDate: '{{$maxDate}}',
                @endif
            });
        }
        initDatePicker();
    </script>
@endpush



<x-admin.element.form-group
    :parentClass="$parentClass"
    :name="$name"
    :required="$required"
    :label="$label"
    :helperLabel="$helperLabel"
>
    <input type="text"
           @if (isset($id))
               id="{{$id}}"
           @endif
           @if (isset($required) && $required==true)
               required data-validation-required-message="این فیلد الزامی میباشد"
           @endif
           placeholder="{{$placeholder}}"
           {{ $attributes }}
           @class([
                    'form-control',
                    $class,
                ])
           value="{{$value??old($name)}}"
           name="{{$name}}">
</x-admin.element.form-group>
