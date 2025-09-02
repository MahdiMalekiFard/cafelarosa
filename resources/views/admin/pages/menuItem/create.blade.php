<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menuItem.model')])=>route('admin.menu-item.index')]"
    :title="trans('general.page.create.page_title',['model'=>trans('menuItem.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.create.title',['model'=>trans('menuItem.model')])"
        :action="route('admin.menu-item.store')"
    >
        <input hidden name="locale" value="{{ app()->getLocale() }}"/>

        <x-admin.element.select
            parent-class="col-lg-12"
            :label="trans('validation.attributes.menu')"
            name="menu_id"
            :options="$menus"
            required="1"
        />

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

        <x-admin.element.input
            parent-class="col-lg-6"
            type="price"
            :label="trans('validation.attributes.normal_price')"
            name="normal_price"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-6"
            type="price"
            :label="trans('validation.attributes.special_price')"
            name="special_price"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.menu-item.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
