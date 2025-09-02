@props(['item' => null,'colClass'=>'col-lg-12'])
<x-admin.element.input
    :parent-class="$colClass"
    :label="trans('validation.attributes.seo_title')"
    name="seo_title"
    :value="old('seo_title',optional($item)->seo_title)"
/>

<x-admin.element.text-area
    :parent-class="$colClass"
    :label="trans('validation.attributes.seo_description')"
    name="seo_description"
    :value="old('seo_description',optional($item)->seo_description)"
/>
