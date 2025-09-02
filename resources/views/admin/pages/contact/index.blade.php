@push('js')
    <script>
        var datatable_url = '/admin/contact';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'phone', name: 'phone'},
            {data: 'email', name: 'email'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('contact.model')])=>route('admin.contact.index')]"
    :title="trans('general.page.index.title',['model'=>trans('contact.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.name'),
                    trans('validation.attributes.phone'),
                    trans('validation.attributes.email'),
                    trans('datatable.actions'),
            ]"
        :actions="[]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
