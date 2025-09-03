@props([
'parentClass' => '',
'class' => '',
'id'=>null,
'name'=>'',
'type'=>'text',
'value'=>null,
'label'=>'',
'helperLabel'=>null,
'required'=>0,
'selected'=>false,
])


<div class="{{ $parentClass }}">
    {{-- Fallback so unchecked sends 0 --}}
    <input type="hidden" name="{{ $name }}" value="0">

    <label {{ $attributes->merge(['class' => 'form-check form-check-custom form-check-solid ' . $class]) }}>
        <input
            id="{{ $id ?? $name }}"
            class="form-check-input"
            type="checkbox"
            name="{{ $name }}"
            value="1"
            @checked(old($name, (bool)$selected))
        />
        <span class="form-check-label">{{ $label }}</span>
    </label>

    @if($helperLabel)
        <small class="text-muted">{{ $helperLabel }}</small>
    @endif
</div>
