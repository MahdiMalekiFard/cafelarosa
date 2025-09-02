<form action="{{route('admin.page.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.page.edit',$row->id)}}"><i class="fa fa-pen"></i></a>
    </div>
</form>
