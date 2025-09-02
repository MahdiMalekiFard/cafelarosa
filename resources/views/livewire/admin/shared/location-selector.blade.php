<div class="row">
    <x-admin.element.select
        required="1"
        parent-class="col-md-6"
        :label="__('validation.attributes.country_id')"
        name="country_id"
        wire:model.live="countryId"
    >
        <option value="">{{__('general.please_select_an_option')}}</option>
        @foreach($countries as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
    </x-admin.element.select>

    <x-admin.element.select
        required="1"
        parent-class="col-md-6"
        :label="__('validation.attributes.province_id')"
        name="province_id"
        wire:model.live="provinceId"
    >
        <option value="">{{__('general.please_select_an_option')}}</option>
        @foreach($provinces as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
    </x-admin.element.select>

    <x-admin.element.select
        required="1"
        parent-class="col-md-6"
        :label="__('validation.attributes.city_id')"
        name="city_id"
        wire:model.live="cityId"
    >
        <option value="">{{__('general.please_select_an_option')}}</option>
        @foreach($cities as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>
        @endforeach
    </x-admin.element.select>

    @if($withArea)
        <x-admin.element.select
            parent-class="col-md-6"
            :label="__('validation.attributes.area_id')"
            name="area_id"
            wire:model.live="areaId"
        >
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach($areas as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </x-admin.element.select>
    @endif


    @if($withLocality)
        <x-admin.element.select
            parent-class="col-md-6"
            :label="__('validation.attributes.locality_id')"
            name="locality_id"
            wire:model.live="localityId"
        >
            <option value="">{{__('general.please_select_an_option')}}</option>
            @foreach($localities as $item)
                <option value="{{$item->id}}">{{$item->title}}</option>
            @endforeach
        </x-admin.element.select>
    @endif
</div>