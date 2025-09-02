<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('comment.model')])=>route('admin.comment.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('comment.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('comment.model'),'name'=>$comment->title])"
        :action="route('admin.comment.update',$comment->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$comment->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.comment.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>