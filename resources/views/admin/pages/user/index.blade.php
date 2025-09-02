@push('js')
    <script>
        var datatable_url = '/admin/user';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'created_at', name: 'created_at'},
            {data: 'mobile_verify_at', name: 'mobile_verify_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('user.model')])=>route('admin.user.index')]"
    :title="trans('general.page.index.title',['model'=>trans('user.model')])">

    <x-admin.widget.datatable
            :rows="[
                    '#','Name','Email','Register Date','Status','Actions'
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('user.model')])=>route('admin.user.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
