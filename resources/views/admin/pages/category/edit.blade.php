<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('category.model')])=>route('admin.category.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('category.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('category.model'),'name'=>$category->title])"
        :action="route('admin.category.update',$category->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$category->title"
        />

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.description')"
            name="description"
            required="1"
            :value="$category->description"
        />

        <x-admin.element.select
            parent-class="col-lg-12"
            name="type"
            :label="trans('validation.attributes.type')"
            required="1"
            :type="\App\Enums\CategoryTypeEnum::class"
            :value="$category->type->value"
        />

        <x-admin.element.tinymce
            :label="trans('validation.attributes.body')"
            :required="1"
            :value="$category->body"
            type="edit"
            name="body"/>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.category.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
