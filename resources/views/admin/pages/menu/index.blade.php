@push('js')
    <script>
        var datatable_url = '/admin/menu';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menu.model')])=>route('admin.menu.index')]"
    :title="trans('general.page.index.title',['model'=>trans('menu.model')])">

    <x-admin.widget.datatable
        :rows="[
                    trans('datatable.id'),
                    trans('datatable.title'),
                    trans('datatable.published'),
                    trans('datatable.created_at'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('menu.model')])=>route('admin.menu.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
