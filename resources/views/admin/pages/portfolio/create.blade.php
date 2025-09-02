<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('portfolio.model')])=>route('admin.portfolio.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('portfolio.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('portfolio.model')])"
        :action="route('admin.portfolio.store')"
        :multipart="1"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />

        <x-admin.shared.categories-dropdown
            parent-class="col-md-12"
            :label="trans('validation.attributes.category')"
            name="categories_id[]"
            :required="1"
            :multiple="1"
            category-type="portfolio"
        />

        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.description')"
            name="description"
        />

        <x-admin.element.tinymce
            :label="trans('validation.attributes.body')"
            :required="1"
            name="body"/>

        <x-admin.element.dropify
            parent-class="col-md-12"
            :label="trans('validation.attributes.image')"
            name="image"/>

        <x-admin.shared.seo-config />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.portfolio.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
