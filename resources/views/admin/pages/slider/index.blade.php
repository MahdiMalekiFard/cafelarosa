@push('js')
    <script>
        var datatable_url = '/admin/slider';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('slider.model')])=>route('admin.slider.index')]"
    :title="trans('general.page.index.title',['model'=>trans('slider.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.title'),
                    trans('datatable.created_at'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('slider.model')])=>route('admin.slider.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
