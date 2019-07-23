<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('titles.title')</th>
            <th>@lang('titles.duration')</th>
            <th>@lang('titles.season')</th>
            <th>@lang('titles.series')</th>
            <th>@lang('titles.release_date')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($episodes as $episode)
            <tr>
                <td>{{$episode->title}}</td>
                <td>{{$episode->duration}}</td>
                <td>{{$episode->season->title}}</td>
                <td>{{$season->series->title}}</td>
                <td>{{\Carbon\Carbon::parse($episode->release_date)->format('D M Y')}}</td>
                <td>
                    {!! Form::open(['route' => ['episodes.destroy', $episode->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('episodes.show', [$episode->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>
                        <a href="{!! route('episodes.edit', [$episode->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        <a href="{!! route('episodes.slider', [$episode->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('titles.edit_slider')}}"><i class="far fa-images"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$episodes->links()}}