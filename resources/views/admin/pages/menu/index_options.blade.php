<form action="{{route('admin.menu.destroy',$row->id)}} " method="post">
    @method('delete')
    @csrf
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.menu.edit',$row->id)}}" @conditionalNavigate(wire:navigate)><i class="fa fa-pen"></i></a>
        <a role="button" class="btn btn-secondary btn-active-dark" href="{{route('admin.menu.toggle',$row->id)}}"><i class="fa fa-toggle-on"></i></a>
        
        <button type="submit" class="btn btn-secondary btn-active-danger sa-warning"><i class="fa fa-trash"></i></button>
    </div>
</form>
