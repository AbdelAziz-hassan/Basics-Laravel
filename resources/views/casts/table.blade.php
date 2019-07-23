<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('casts.person')</th>
            <th>@lang('casts.character')</th>
            <th>@lang('casts.role')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($casts as $cast)
            <tr>
                <td>{{$cast->person->name}}</td>
                <td>{{$cast->character->name??''}}</td>
                <td>{{$cast->role->role}}</td>
                <td>
                    {!! Form::open(['route' => ['casts.destroy', $cast->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        {{--<a href="{!! route('casts.show', [$cast->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>--}}
                        <a href="{!! route('casts.edit', [$cast->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
