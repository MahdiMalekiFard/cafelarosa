<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('portfolio.model')])=>route('admin.portfolio.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('portfolio.model')])">
    <x-admin.widget.form-card-transparent
        body_class="p-lg-5 p-sm-0"
        :title="trans('general.page.edit.title',['model'=>trans('portfolio.model'),'name'=>$portfolio->title])"
        :action="route('admin.portfolio.update',$portfolio->id)"
        :multipart="1"
        method="PATCH"
    >
        <input hidden name="locale" value="{{app()->getLocale()}}"/>

        <x-admin.widget.card class="col-lg-8">

            <x-admin.element.input
                parent-class="col-lg-12"
                :label="trans('validation.attributes.title')"
                name="title"
                required="1"
                :value="$portfolio->title"
            />

            <x-admin.element.text-area
                parent-class="col-lg-12"
                :label="trans('validation.attributes.description')"
                name="description"
                :value="$portfolio->description"
            />

            <x-admin.element.tinymce
                parent-class="col-lg-12"
                :label="trans('validation.attributes.body')"
                :required="1"
                name="body"
                type="edit"
                :value="$portfolio->body"/>

        </x-admin.widget.card>

        <div class="col-lg-3 mt-5 mt-lg-0">
            <x-admin.widget.card class="">

                <x-admin.element.dropify
                    :label="trans('validation.attributes.image')"
                    name="image"
                    required="0"
                    resolution="854*450"
                    default="{{$portfolio->getFirstMediaUrl('image','480')}}"/>

                <x-admin.shared.categories-dropdown
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.category')"
                    name="categories_id[]"
                    :multiple="1"
                    :required="1"
                    :selected-rows="$selectedCategories"
                />

                {{--                <x-admin.shared.tags-dropdown--}}
                {{--                        parent-class="col-lg-12"--}}
                {{--                        :label="trans('validation.attributes.tags_id')"--}}
                {{--                        name="tags_id[]"--}}
                {{--                        :multiple="1"--}}
                {{--                        :required="0"--}}
                {{--                        :selected-rows="$selectedTags"--}}
                {{--                />--}}

            </x-admin.widget.card>
            <x-admin.widget.card class="mt-5">
                <x-admin.shared.seo-config :item="$portfolio"/>
            </x-admin.widget.card>
        </div>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.portfolio.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>
