@push('js')
    <script>
        var datatable_url = '/admin/portfolio';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'categories_title', name: 'categories_title'},
            {data: 'total_view', name: 'total_view', orderable: false},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('portfolio.model')])=>route('admin.portfolio.index')]"
    :title="trans('general.page.index.title',['model'=>trans('portfolio.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.title'),
                    trans('datatable.categories_title'),
                    trans('datatable.view_count'),
                    trans('datatable.published'),
                    trans('datatable.created_at'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('portfolio.model')])=>route('admin.portfolio.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
