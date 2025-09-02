<div class="row">
    @foreach($properties as $property)
        <x-admin.element.checkbox
            @class([$class])
            :label="$property->title"
            :value="$property->id"
            name="properties[]"
            :selected="in_array($property->id,$checkedIds)"
        />
    @endforeach
</div>