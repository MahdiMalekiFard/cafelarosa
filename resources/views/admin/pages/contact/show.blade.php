<x-admin.layout.master
    title="show"
>
    <x-admin.widget.card title="Info">
        @slot('actions')
            <a href="{{route('admin.contact.index')}}" class="btn btn-sm btn-primary">{{trans('general.back')}}</a>
        @endslot
        <p><strong>name:</strong> {{ $contact->name }}</p>
        <p><strong>phone:</strong> {{ $contact->phone }}</p>
        <p><strong>email:</strong> {{ $contact->email }}</p>
    </x-admin.widget.card>

    <br>

    <x-admin.widget.card title="Message">
        <p>{{ $contact->message }}</p>
    </x-admin.widget.card>
</x-admin.layout.master>
