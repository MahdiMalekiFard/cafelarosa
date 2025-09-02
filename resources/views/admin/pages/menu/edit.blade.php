<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('menu.model')])=>route('admin.menu.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('menu.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('menu.model'),'name'=>$menu->title])"
        :action="route('admin.menu.update',$menu->id)"
        :multipart="1"
        method="PATCH"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            :value="$menu->title"
            required="1"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            :value="$menu->description"
            required="1"
        />

        <x-admin.element.dropify
            parent-class="col-md-6"
            :label="trans('validation.attributes.W_L_image')"
            name="left_image"
            resolution="854*450"
            default="{{$menu->getFirstMediaUrl('left_image','480')}}"
        />

        <x-admin.element.dropify
            parent-class="col-md-6"
            :label="trans('validation.attributes.W_R_image')"
            name="right_image"
            resolution="854*450"
            default="{{$menu->getFirstMediaUrl('right_image','480')}}"
        />

        <x-admin.element.dropify
            parent-class="col-md-12"
            :label="trans('validation.attributes.W_D_image')"
            name="image"
            resolution="854*450"
            default="{{$menu->getFirstMediaUrl('image','480')}}"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.menu.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
