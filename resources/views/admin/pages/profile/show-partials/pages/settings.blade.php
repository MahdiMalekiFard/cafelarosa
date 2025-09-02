<x-admin.widget.form-card
        form="settings_form"
        title="Personal Information"
        :action="route('admin.profile.updatePersonalSetting',$profile->id)"
        method="PATCH"
        multipart>

    <x-admin.element.select
            name="theme"
            :label="trans('profile.theme')"
            :value="$profile->extra_attributes->get(\App\ExtraAttributes\ProfileExtraEnum::THEME->value,'light')"
            required
            horizontal
            solid="1"
            class="form-control-lg"
            :options="[
            'light'=>trans('profile.theme_modes.light'),
            'dark'=>trans('profile.theme_modes.dark'),
            'system'=>trans('profile.theme_modes.system'),
            ]"
    >
    </x-admin.element.select>
    <x-admin.element.select
            name="language"
            :label="trans('profile.language')"
            :value="$profile->extra_attributes->get(\App\ExtraAttributes\ProfileExtraEnum::LANGUAGE->value,config('app.locale'))"
            required
            horizontal
            solid="1"
            class="form-control-lg"
            :options="[
            'fa'=>trans('language.fa'),
            'en'=>trans('language.en'),
            ]"
    >
    </x-admin.element.select>

    <x-admin.element.select
            name="container"
            :label="trans('profile.container')"
            :value="$profile->extra_attributes->get(\App\ExtraAttributes\ProfileExtraEnum::CONTAINER->value,'boxed')"
            required
            horizontal
            solid="1"
            class="form-control-lg"
            :options="[
            'boxed'=>trans('profile.container_mode.boxed'),
            'full'=>trans('profile.container_mode.full'),
            ]"
    >
    </x-admin.element.select>

    @slot('footer')
        <x-admin.widget.form-sumbit form="settings_form"/>
    @endslot
</x-admin.widget.form-card>
