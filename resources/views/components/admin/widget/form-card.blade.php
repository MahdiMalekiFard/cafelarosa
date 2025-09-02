@props([
    'id'=>'form',
    'action'=>'',
    'method'=>'POST',
    'validate'=>0,
    'multipart'=>0,
    'title'=>null,
    'footer'=>null,
    'actions'=>null,
    'alert'=>null
])

<x-admin.widget.form
    :action="$action"
    :method="$method"
    :validate="$validate"
    :multipart="$multipart"
    :alert="$alert"
    :id="$id"
    {{$attributes}}
>
    <x-admin.widget.card :title="$title" :actions="$actions" :footer="$footer">
        {{$slot}}
    </x-admin.widget.card>
</x-admin.widget.form>