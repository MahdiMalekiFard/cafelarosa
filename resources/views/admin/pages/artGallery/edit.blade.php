<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('artGallery.model')])=>route('admin.art-gallery.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('artGallery.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('artGallery.model'),'name'=>$artGallery->title])"
        :action="route('admin.art-gallery.update',$artGallery->id)"
        :multipart="1"
        method="PATCH"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$artGallery->title"
        />

        <x-admin.element.text-area
            parent-class="col-md-12"
            :label="trans('validation.attributes.description')"
            name="description"
            :value="$artGallery->description"
        />

        <x-admin.element.dropify
            label="Folder Image"
            name="image"
            required="0"
            resolution="854*450"
            default="{{$artGallery->getFirstMediaUrl('image','480')}}"
        />

        <x-admin.element.dropzone
            type="edit"
            :data="$artGallery->getMedia('gallery')->map(function ($media) {
                    return [
                        'id'                => $media->id,
                        'original_url'      => $media->getUrl(),
                        'file_name'         => $media->file_name,
                        'size'              => $media->size,
                    ];
                })->toJson()"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.art-gallery.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
