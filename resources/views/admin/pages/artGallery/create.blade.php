<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('artGallery.model')])=>route('admin.art-gallery.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('artGallery.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('artGallery.model')])"
        :action="route('admin.art-gallery.store')"
        :multipart="1"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
        />

        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.description')"
            name="description"
        />

        <x-admin.element.dropify
            parent-class="col-md-12"
            label="Folder Image"
            name="image"
        />

        <x-admin.element.dropzone name="documentsDropzone" label="Galleries"/>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.art-gallery.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
