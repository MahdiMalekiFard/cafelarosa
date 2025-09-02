<div class="">
    @if(!empty($message))
        <p class="text-success">{{$message}}</p>
    @endif
    <x-admin.widget.card title="{{ trans('static_content.model') }}">

        @foreach(config('app.supported_locales') as $locale)
            <x-admin.widget.card :title="$locale">
                <x-admin.element.input
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.title')"
                    name="about_us.{{$locale}}.title"
                    wire:model="about_us.{{$locale}}.title"
                    required="1"
                />
                <x-admin.element.text-area
                    parent-class="col-lg-12"
                    :label="trans('validation.attributes.value')"
                    name="about_us.{{$locale}}.value"
                    wire:model="about_us.{{$locale}}.value"
                />
            </x-admin.widget.card>

        @endforeach

        <x-admin.element.dropify
            :label="trans('validation.attributes.image')"
            name="image"
            resolution="854*450"
            wire-model="image"
            show-remove-button="0"
            dom-re-rendering-by-livewire="0"
            default="{{ static_content_object('about_us')?->getFirstMediaUrl('image') ?? '' }}"
            class="my-4"
        />

        <button class="btn btn-sm btn-primary" wire:click="saveAboutUs" wire:loading.class="disabled" wire:target="saveAboutUs">{{trans('general.submit')}}</button>
    </x-admin.widget.card>
</div>
