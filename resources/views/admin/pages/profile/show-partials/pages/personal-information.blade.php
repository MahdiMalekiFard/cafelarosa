<x-admin.widget.form-card
        id="personal_information_form"
        title="Personal Information"
        :action="route('admin.profile.update',$profile->id)"
        method="PATCH"
        alert="personal_information_form_alert"
        multipart>
    <x-admin.element.dropify
            name="avatar"
            label="Avatar"
            horizontal
            :default="$user->getFirstMediaUrl('avatar','512')"
    />
    <x-admin.element.input
            name="name"
            :label="trans('validation.attributes.firstname')"
            :value="$user->name"
            required
            horizontal
            solid="1"
            class="form-control-lg"
    />
    <x-admin.element.input
            name="family"
            :label="trans('validation.attributes.lastname')"
            :value="$user->family"
            required
            horizontal
            solid="1"
            class="form-control-lg"
    />

    <x-admin.element.input
            name="mobile"
            :label="trans('validation.attributes.mobile')"
            :value="$user->mobile"
            required
            horizontal
            solid="1"
            class="form-control-lg"
    />

    @slot('footer')
        <x-admin.widget.form-sumbit form="personal_information_form" alert="personal_information_form_alert"/>
    @endslot
</x-admin.widget.form-card>
