<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('characters.name')</th>
            <th>@lang('titles.title')</th>
            <th>@lang('persons.person')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($characters as $character)
            <tr>
                <td>{{$character->name}}</td>
                <td>{{$character->casts?$character->casts->title->title:null}}</td>
                <td>{{$character->casts?$character->casts->person->name:null}}</td>
                <td>
                    {!! Form::open(['route' => ['characters.destroy', $character->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
{{--                        <a href="{!! route('characters.show', [$character->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>--}}                       <a href="{!! route('characters.edit', [$character->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        <a href="{!! route('characters.slider', [$character->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('titles.edit_slider')}}"><i class="far fa-images"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$characters->links()}}