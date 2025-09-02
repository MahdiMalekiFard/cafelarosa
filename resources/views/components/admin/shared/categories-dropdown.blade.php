@props([
'id'=>'category_id_dropdown',
'name'=>'category_id',
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
'categoryType'=>'blog',
])
@push('js')
    <script>
        var category_id_dropdown = $('#{{$id}}').select2({
            placeholder: '{{__('core.search_category')}}',
            allowClear: true,
            ajax: {
                url: '{{route('admin.select.category',['type'=>$categoryType])}}',
                methods: 'POST',
                dataType: 'json',
                data: function (params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                }
            }
        }).on('change', function (e) {
            {{--var data = $('#{{$id}}').select2('val');--}}
            {{--            @this.--}}
            {{--            set('value', data);--}}
        });
        @if(count($selectedRows??[]))
        var ids = @json(collect($selectedRows)->pluck('id'));
        var selectedRows = @json($selectedRows);
                selectedRows.forEach(function(e){
                    category_id_dropdown.append(new Option(e.value, e.id, false, false));
                });
                category_id_dropdown.val(ids).trigger("change");
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
{{--        :value="$value"--}}
        :helper="$helper"
        :helper-label="$helperLabel"
        :solid="$solid"
        :select2="0"
        :multiple="$multiple"
        :name="$name">
    <option></option>
</x-admin.element.select>
