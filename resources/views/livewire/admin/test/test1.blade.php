<div class="" wire:init="init">
    <x-admin.widget.card title="Asynchronous Request">
        @if($message)
            {{$message}}
        @else
            <div class="">...loading</div>
        @endif
    </x-admin.widget.card>
</div>