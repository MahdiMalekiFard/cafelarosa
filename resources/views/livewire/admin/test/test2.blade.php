@script
<script>
    setTimeout(() => {
        console.log('setTimeout');
        $wire.dispatchSelf('init');
    }, {{$delay}});

</script>
@endscript
<div class="">
    <x-admin.widget.card title="sleep time is {{$sleepTime}}">

        {{$message}}

    </x-admin.widget.card>
</div>