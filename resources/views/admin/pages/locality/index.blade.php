@push('js')
    <script>
        var datatable_url = '/admin/locality';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('locality.model')])=>route('admin.locality.index')]"
    :title="trans('general.page.index.title',['model'=>trans('locality.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('locality.model')])=>route('admin.locality.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
