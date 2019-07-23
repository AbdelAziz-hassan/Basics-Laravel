<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('users.picture')</th>
            <th>@lang('users.name')</th>
            <th>@lang('users.email')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td><img class="img-small" src="/{{$user->picture}}" alt="user's image"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    @if($user->hasGroup('supers'))
                        @if(\Auth::user()->hasGroup('supers'))
                            {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                                <div class='btn-group'>
                                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                                </div>
                            {!! Form::close() !!}
                        @endif
                    @else
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                    @endif
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$users->links()}}