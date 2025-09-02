@php use App\Enums\YesNoEnum;use App\Helpers\Constants; @endphp
@push('js')

@endpush
<x-admin.layout.master
    :title="trans('general.page.edit.page_title',['model'=>trans('profile.model')])">
    <x-admin.widget.form-card-transparent
        :action="route('admin.profile.update',$profile->id)"
        method="PATCH">

        <div class="row col-lg-4">

            <x-admin.widget.card class=""
                                 id="docs_sticky_summary"
                                 :title="__('core.information')">
                <x-admin.element.input
                    parent-class="col-md-12"
                    :label="trans('validation.attributes.name')"
                    name="name"
                    required="1"
                    :value="$profile->user->name"
                />

                <x-admin.element.input
                    parent-class="col-md-12"
                    :label="trans('validation.attributes.last_name')"
                    name="family"
                    required="1"
                    :value="$profile->user->family"
                />

                <x-admin.element.input
                    parent-class="col-md-12"
                    :label="trans('validation.attributes.mobile')"
                    name="mobile"
                    required="1"
                    :value="$profile->user->mobile"
                />
                <x-admin.element.text-area
                    parent-class="col-md-12"
                    :label="trans('validation.attributes.bio')"
                    name="bio"
                    required="1"
                    :value="$profile->bio"
                />
            </x-admin.widget.card>

            <x-admin.widget.card class="mt-5" :title="__('core.image_slides')">
                <x-admin.element.dropify
                    parent-class="col-lg-12"
                    :label="__('core.image')"
                    name="avatar"
                    required="0"
                    :helper-label="Constants::RESOLUTION_512_SQUARE"
                    default="{{loadMedia($profile->user,'avatar','512')}}"
                />
            </x-admin.widget.card>
        </div>
        <div class="row col-lg-8">

            {{--            <x-admin.widget.card class="ms-lg-5 mt-sm-5 mt-md-0" :title="__('core.location')">--}}
            {{--                <livewire:admin.shared.location-selector--}}
            {{--                    :country-id="$profile?->user?->city?->province?->country_id"--}}
            {{--                    :province-id="$profile?->user?->city?->province_id"--}}
            {{--                    :city-id="$profile?->user?->city_id"--}}
            {{--                    :area-id="$profile?->user?->area_id"--}}
            {{--                    :locality-id="$profile?->user?->locality_id"--}}
            {{--                />--}}

            {{--                <x-admin.element.input--}}
            {{--                    parent-class="col-md-6"--}}
            {{--                    :label="trans('validation.attributes.latitude')"--}}
            {{--                    name="latitude"--}}
            {{--                    required="0"--}}
            {{--                    :value="$profile->latitude"--}}
            {{--                />--}}
            {{--                <x-admin.element.input--}}
            {{--                    parent-class="col-md-6"--}}
            {{--                    :label="trans('validation.attributes.longitude')"--}}
            {{--                    name="longitude"--}}
            {{--                    required="0"--}}
            {{--                    :value="$profile->longitude"--}}
            {{--                />--}}

            {{--                <x-admin.element.text-area--}}
            {{--                    parent-class="col-md-12"--}}
            {{--                    :label="trans('validation.attributes.address')"--}}
            {{--                    name="address"--}}
            {{--                    required="1"--}}
            {{--                    :value="$profile->address"--}}
            {{--                />--}}
            {{--            </x-admin.widget.card>--}}


            <x-admin.widget.card class="ms-lg-5 mt-5" title="Setting">

                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.enable_notification')"
                    name="enable_notification"
                    required="0"
                    :value="$profile->enable_notification"
                    :type="YesNoEnum::class"
                />

                <x-admin.element.select
                    parent-class="col-md-6"
                    :label="trans('validation.attributes.enable_subscription')"
                    name="enable_subscription"
                    required="0"
                    :value="$profile->enable_subscription"
                    :type="YesNoEnum::class"
                />
            </x-admin.widget.card>
        </div>


        @slot('footer')
            <x-admin.widget.form-sumbit :back-route="route('admin.index')"/>
        @endslot
    </x-admin.widget.form-card-transparent>
</x-admin.layout.master>
