<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('blog.model')])=>route('admin.blog.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('blog.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('blog.model')])"
        :action="route('admin.blog.store')"
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
            category-type="blog"
        />

        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
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
            <x-admin.widget.form-sumbit :back-route="route('admin.blog.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
