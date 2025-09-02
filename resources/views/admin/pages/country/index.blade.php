@push('js')
    <script>
        var datatable_url = '/admin/country';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('country.model')])=>route('admin.country.index')]"
    :title="trans('general.page.index.title',['model'=>trans('country.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('country.model')])=>route('admin.country.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
