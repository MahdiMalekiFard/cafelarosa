<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menuItem.model')])=>route('admin.menu-item.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('menuItem.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('menuItem.model'),'name'=>$menuItem->title])"
        :action="route('admin.menu-item.update',$menuItem->id)"
        method="PATCH"
    >
        <input hidden name="locale" value="{{ app()->getLocale() }}"/>

        <x-admin.element.select
            parent-class="col-lg-12"
            :label="trans('validation.attributes.menu')"
            name="menu_id"
            :options="$menus"
            :value="$menuItem->menu?->id"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            :value="$menuItem->title"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            :value="$menuItem->description"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-6"
            type="price"
            :label="trans('validation.attributes.normal_price')"
            name="normal_price"
            :value="$menuItem->normal_price"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-6"
            type="price"
            :label="trans('validation.attributes.special_price')"
            name="special_price"
            :value="$menuItem->special_price"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.menu-item.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
