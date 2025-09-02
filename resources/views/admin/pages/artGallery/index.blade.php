@push('js')
    <script>
        var datatable_url = '/admin/art-gallery';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('artGallery.model')])=>route('admin.art-gallery.index')]"
    :title="trans('general.page.index.title',['model'=>trans('artGallery.model')])">

    <x-admin.widget.datatable
            :rows="[
                    trans('datatable.id'),
                    trans('datatable.title'),
                    trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('artGallery.model')])=>route('admin.art-gallery.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
