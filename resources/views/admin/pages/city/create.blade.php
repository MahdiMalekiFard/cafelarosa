<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('city.model')])=>route('admin.city.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('city.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('city.model')])"
        :action="route('admin.city.store')">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.city.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
