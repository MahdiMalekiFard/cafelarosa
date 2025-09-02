<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menu.model')])=>route('admin.menu.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('menu.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('menu.model')])"
        :action="route('admin.menu.store')"
        :multipart="1"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

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

        <x-admin.element.dropify
            parent-class="col-md-6"
            :label="trans('validation.attributes.W_L_image')"
            name="left_image"
        />

        <x-admin.element.dropify
            parent-class="col-md-6"
            :label="trans('validation.attributes.W_R_image')"
            name="right_image"
        />

        <x-admin.element.dropify
            parent-class="col-md-12"
            :label="trans('validation.attributes.W_D_image')"
            name="image"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.menu.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
