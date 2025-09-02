@props([
'id'=>'province_id_dropdown',
'name'=>'user_id',
'class'=>null,
'parentClass'=>null,
'label'=>null,
'type'=>null,
'selectedRows'=>null,
'helper'=>null,
'helperLabel'=>null,
'required'=>0,
'solid'=>0,
'options'=>null,
'select2'=>0,
'multiple'=>0,
])
@push('js')
    <script>
        var province_id_dropdown = $('#{{$id}}').select2({
            placeholder: '{{__('core.search_province')}}',
            allowClear: true,
            ajax: {
                url: '{{route('admin.select.province')}}',
                methods: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data.items, function (item) {
                            return {
                                text: item.text,
                                id: item.uuid
                            }
                        })
                    };
                }
            }
        }).on('change', function (e) {
            {{--var data = $('#{{$id}}').select2('val');--}}
            {{--            @this.--}}
            {{--            set('value', data);--}}
        });

        @if(count($selectedRows??[]))
        var ids = @json(collect($selectedRows)->pluck('uuid'));
        var selectedRows = @json($selectedRows);
            selectedRows.forEach(function (e) {
                province_id_dropdown.append(new Option(e.value, e.uuid, false, false));
            });
        province_id_dropdown.val(ids).trigger('change');
        @endif

    </script>
@endpush

<x-admin.element.select
    :id="$id"
    :class="$class"
    :parent-class="$parentClass"
    :id="$id"
    :required="$required"
    :label="$label"
    :helper="$helper"
    :helper-label="$helperLabel"
    :solid="$solid"
    :multiple="$multiple"
    :select2="0"
    wire:model="value"
    :name="$name">
    <option></option>
</x-admin.element.select>
