<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('groups.group')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
            <tr>
                <td>{{$group->name}}</td>
                <td>
                {!! Form::open(['route' => ['groups.destroy', $group->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('groups.show', [$group->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>
                    @if($group->name =='admins' || $group->name == 'supers')
                    @else
                        <a href="{!! route('groups.edit', [$group->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    @endif
                </div>
                {!! Form::close() !!}
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$groups->links()}}