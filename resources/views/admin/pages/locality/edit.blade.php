<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('locality.model')])=>route('admin.locality.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('locality.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('locality.model'),'name'=>$locality->title])"
        :action="route('admin.locality.update',$locality->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$locality->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.locality.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>