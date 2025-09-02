@push('js')
    <script>
        var datatable_url = '/admin/blog';
        var datatable_columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title', searchable: true},
            {data: 'categories_title', name: 'categories_title'},
            {data: 'total_view', name: 'total_view', orderable: false},
            {data: 'total_like', name: 'total_like'},
            {data: 'total_comment', name: 'total_comment'},
            {data: 'published', name: 'published'},
            {data: 'created_at', name: 'created_at'},
            {data: 'actions', name: 'actions', orderable: false, searchable: false, width: '1%'}
        ];
    </script>
@endpush
<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('blog.model')])=>route('admin.blog.index')]"
    :title="trans('general.page.index.title',['model'=>trans('blog.model')])">

    <x-admin.widget.datatable
        :rows="[
        trans('datatable.id'),
        trans('datatable.title'),
        trans('datatable.categories_title'),
        trans('datatable.view_count'),
        trans('datatable.like_count'),
        trans('datatable.comment_count'),
        trans('datatable.published'),
        trans('datatable.created_at'),
        trans('datatable.actions'),
            ]"
        :actions="[
    trans('general.page.index.create',['model'=>trans('blog.model')])=>route('admin.blog.create'),
    ]">

    </x-admin.widget.datatable>


</x-admin.layout.master>
