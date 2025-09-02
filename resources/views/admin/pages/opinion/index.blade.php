@push('js')
    <script>
        var datatable_url = '/admin/opinion';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'user_name', name: 'user_name'},
            {data: 'subject', name: 'subject'},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('opinion.model')])=>route('admin.opinion.index')]"
    :title="trans('general.page.index.title',['model'=>trans('opinion.model')])">

    <x-admin.widget.datatable
        :rows="[
                    trans('datatable.id'),
                    trans('datatable.user_name'),
                    trans('datatable.subject'),
                    trans('datatable.published'),
                    trans('datatable.created_at'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('opinion.model')])=>route('admin.opinion.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
