<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('opinion.model')])=>route('admin.opinion.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('opinion.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('opinion.model'),'name'=>$opinion->title])"
        :action="route('admin.opinion.update',$opinion->id)"
        method="PATCH"
    >
        <input hidden name="locale" value="{{ app()->getLocale() }}">

        <x-admin.widget.card class="col-lg-8">
            <x-admin.element.input
                parent-class="col-lg-12"
                :label="trans('validation.attributes.subject')"
                name="subject"
                :value="$opinion->subject"
                required="1"
            />

            <x-admin.element.text-area
                parent-class="col-md-12"
                :label="trans('validation.attributes.message')"
                name="comment"
                :value="$opinion->comment"
                required="1"
            />
        </x-admin.widget.card>

        <div class="col-lg-4 mt-5 mt-lg-0">
            <x-admin.widget.card class="">
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.username')"
                    name="user_name"
                    :value="$opinion->user_name"
                    required="1"
                />

                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.company')"
                    name="company"
                    :value="$opinion->company"
                />

                <x-admin.element.input
                    type="number"
                    :label="trans('validation.attributes.ordering')"
                    :value="$opinion->ordering"
                    name="ordering"
                />
            </x-admin.widget.card>
        </div>

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.opinion.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
