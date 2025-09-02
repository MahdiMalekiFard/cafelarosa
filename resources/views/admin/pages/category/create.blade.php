<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('category.model')])=>route('admin.category.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('category.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('category.model')])"
        :action="route('admin.category.store')">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
        />

        <x-admin.element.select
            parent-class="col-lg-12"
            name="type"
            :label="trans('validation.attributes.type')"
            required="1"
            :type="\App\Enums\CategoryTypeEnum::class"
        />

        <x-admin.element.tinymce
            :label="trans('validation.attributes.body')"
            :required="1"
            name="body"/>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.category.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
