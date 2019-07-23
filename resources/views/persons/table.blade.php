<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('persons.name')</th>
            <th>@lang('persons.last_name')</th>
            <th>@lang('persons.birth_date')</th>
            <th>@lang('persons.birth_place')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($persons as $person)
            <tr>
                <td>{{$person->name}}</td>
                <td>{{$person->last_name}}</td>
                <td>{{\Carbon\Carbon::parse($person->birth_date)->format('D M Y')}}</td>
                <td>{{$person->birth_place}}</td>
                <td>
                    {!! Form::open(['route' => ['persons.destroy', $person->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('persons.show', [$person->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>
                        <a href="{!! route('persons.edit', [$person->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        <a href="{!! route('persons.slider', [$person->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('titles.edit_slider')}}"><i class="far fa-images"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$persons->links()}}