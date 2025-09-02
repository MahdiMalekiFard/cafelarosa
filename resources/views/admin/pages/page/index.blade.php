@push('js')
    <script>
        var datatable_url = '/admin/page';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'type', name: 'type'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('page.model')])=>route('admin.page.index')]"
    :title="trans('general.page.index.title',['model'=>trans('page.model')])">

    <x-admin.widget.datatable
        :rows="[
                    trans('datatable.id'),
                    trans('datatable.type'),
                    trans('datatable.title'),
                    trans('datatable.actions'),
            ]"
    ></x-admin.widget.datatable>

</x-admin.layout.master>
