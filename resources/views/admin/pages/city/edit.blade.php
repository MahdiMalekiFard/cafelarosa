<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('city.model')])=>route('admin.city.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('city.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('city.model'),'name'=>$city->title])"
        :action="route('admin.city.update',$city->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$city->name"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.city.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>