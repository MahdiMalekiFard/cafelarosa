@props(['item' => null,'colClass'=>'col-lg-12'])

@php
    use App\Enums\SeoRobotsMetaEnum;
    $seoOption = $item ? $item->seoOption : null;
@endphp

<x-admin.element.input
    :parent-class="$colClass"
    :label="trans('validation.attributes.seo_title')"
    name="seo_title"
    :value="old('seo_title', $seoOption?->title ?? null)"
/>

<x-admin.element.text-area
    :parent-class="$colClass"
    :label="trans('validation.attributes.seo_description')"
    name="seo_description"
    :value="old('seo_description', $seoOption?->description ?? null)"
/>

<x-admin.element.input
    :parent-class="$colClass"
    :label="trans('validation.attributes.canonical')"
    name="canonical"
    type="url"
    :value="old('canonical', $seoOption?->canonical ?? null)"
/>

<x-admin.element.input
    :parent-class="$colClass"
    :label="trans('validation.attributes.old_url')"
    name="old_url"
    type="url"
    :value="old('old_url', $seoOption?->old_url ?? null)"
/>

<x-admin.element.input
    :parent-class="$colClass"
    :label="trans('validation.attributes.redirect_to')"
    name="redirect_to"
    type="url"
    :value="old('redirect_to', $seoOption?->redirect_to ?? null)"
/>

<x-admin.element.select
    :parent-class="$colClass"
    :label="trans('validation.attributes.robots_meta')"
    name="robots_meta"
    :type="SeoRobotsMetaEnum::class"
    :value="old('robots_meta', $seoOption?->robots_meta?->value ?? SeoRobotsMetaEnum::INDEX_FOLLOW->value)"
/>
