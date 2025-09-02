@push('js')
    <script>
        var datatable_url = '/admin/menu-item';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'normal_price', name: 'normal_price'},
            {data: 'special_price', name: 'special_price'},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menuItem.model')])=>route('admin.menu-item.index')]"
    :title="trans('general.page.index.title',['model'=>trans('menuItem.model')])">

    <x-admin.widget.datatable
        :rows="[
                    trans('datatable.id'),
                    trans('datatable.title'),
                    trans('datatable.normal_price'),
                    trans('datatable.special_price'),
                    trans('datatable.published'),
                    trans('datatable.created_at'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('menuItem.model')])=>route('admin.menu-item.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
