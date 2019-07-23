<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('titles.title')</th>
            <th>@lang('titles.duration')</th>
            <th>@lang('titles.type')</th>
            <th>@lang('titles.release_date')</th>
            <th>@lang('titles.rate')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($titles as $title)
            <tr>
                <td>{{$title->title}}</td>
                <td>{{$title->duration}}</td>
                <td>{{$title->type}}</td>
                <td>{{\Carbon\Carbon::parse($title->release_date)->format('D M Y')}}</td>
                <td>{{$title->rate}}</td>
                <td>
                    {!! Form::open(['route' => ['titles.destroy', $title->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('titles.show', [$title->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.show')}}"><i class="fas fa-eye"></i></a>
                        <a href="{!! route('titles.edit', [$title->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                        <a href="{!! route('titles.slider', [$title->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('titles.edit_slider')}}"><i class="far fa-images"></i></a>
                        {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$titles->links()}}