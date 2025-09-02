@push('js')
    <script>
        var datatable_url = '/admin/activation-code';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('activationCode.model')])=>route('admin.activation-code.index')]"
    :title="trans('general.page.index.title',['model'=>trans('activationCode.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('activationCode.model')])=>route('admin.activation-code.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
