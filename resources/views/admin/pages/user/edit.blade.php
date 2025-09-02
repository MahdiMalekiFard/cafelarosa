<x-admin.layout.master
    :stack="[trans('general.page.index.title',['model'=>trans('user.model')])=>route('admin.user.index')]"
    :title="trans('general.page.edit.page_title',['model'=>trans('user.model')])">
    <x-admin.widget.form-card
        :title="trans('general.page.edit.title',['model'=>trans('user.model'),'name'=>$user->name])"
        :action="route('admin.user.update',$user->id)"
        method="PATCH">

        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.username')"
            name="name"
            required="1"
            :value="$user->name"
        />
        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.mobile')"
            name="mobile"
            required="1"
            :value="$user->mobile"
        />
        <x-admin.element.input
            parent-class="col-lg-12"
            :label="trans('validation.attributes.email')"
            name="email"
            required="1"
            :value="$user->email"
        />

        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.user.index')"/>
        @endslot
    </x-admin.widget.form-card>
</x-admin.layout.master>
