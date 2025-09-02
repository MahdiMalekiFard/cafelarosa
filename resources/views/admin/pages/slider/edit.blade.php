<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('slider.model')])=>route('admin.slider.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('slider.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('slider.model'),'name'=>$slider->title])"
        :action="route('admin.slider.update',$slider->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$slider->title"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
            :value="$slider->description"
        />

        <x-admin.element.dropify
            parent-class="col-md-12"
            :label="trans('validation.attributes.image')"
            name="image"
            helper-label="1280*720"
            default="{{$slider->getFirstMediaUrl('image','720')}}"/>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.slider.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
