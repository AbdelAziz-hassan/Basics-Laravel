<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('titles.title')</th>
            <th>@lang('titles.duration')</th>
            <th>@lang('titles.series')</th>
            <th>@lang('titles.episodes_numbers')</th>
            <th>@lang('titles.release_date')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($seasons as $season)
            <tr>
                <td>{{$season->title}}</td>
                <td>{{$season->duration}}</td>
                <td>{{$season->series->title}}</td>
                <td>{{$season->episodes_numbers}}</td>
                <td>{{\Carbon\Carbon::parse($season->release_date)->format('D M Y')}}</td>
                <td>
                    {!! Form::open(['route' => ['seasons.destroy', $season->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('seasons.show', [$season->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>
                        <a href="{!! route('seasons.edit', [$season->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        <a href="{!! route('seasons.slider', [$season->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('titles.edit_slider')}}"><i class="far fa-images"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$seasons->links()}}