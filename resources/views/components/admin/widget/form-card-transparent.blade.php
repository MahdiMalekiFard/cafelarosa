@props([
    'id'=>'form',
    'action'=>'',
    'method'=>'POST',
    'validate'=>0,
    'multipart'=>0,
    'title'=>null,
    'footer'=>null,
    'actions'=>null,
    'class'=>null,
    'body_class'=>null,
])

<x-admin.widget.form
    :action="$action"
    :method="$method"
    :validate="$validate"
    :multipart="$multipart"
    :id="$id"
    {{$attributes}}
>
    <x-admin.widget.card :title="$title" :actions="$actions" :footer="$footer" @class(['card-flush shadow-none border-0 bg-transparent',$class]) :body_class="$body_class">
        {{$slot}}
    </x-admin.widget.card>
</x-admin.widget.form>