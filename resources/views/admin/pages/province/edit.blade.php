<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('province.model')])=>route('admin.province.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('province.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('province.model'),'name'=>$province->title])"
        :action="route('admin.province.update',$province->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$province->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.province.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>