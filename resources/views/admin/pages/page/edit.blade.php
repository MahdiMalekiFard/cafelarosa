<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('page.model')])=>route('admin.page.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('page.model')])">
    <x-admin.widget.form-card
        :title="$page->type->title()"
        :action="route('admin.page.update',$page->id)"
        method="PATCH"
    >
        <input hidden name="locale" value="{{ app()->getLocale() }}">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.title')"
            name="title"
            required="1"
            :value="$page->title"
        />

        <x-admin.element.text-area
            parent-class="col-lg-12"
            :label="trans('validation.attributes.body')"
            name="body"
            required="1"
            :value="$page->body"
        />

        <input hidden name="type" value="{{ $page->type->value }}">

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.page.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
