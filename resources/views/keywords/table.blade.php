<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('keywords.keyword')</th>
            <th>@lang('app.actions')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($keywords as $keyword)
            <tr>
                <td>{{$keyword->keyword}}</td>
                <td>
                {!! Form::open(['route' => ['keywords.destroy', $keyword->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('keywords.edit', [$keyword->id]) !!}" class='btn btn-default btn-xs' data-toggle="tooltip" data-placement="bottom" title="{{trans('app.edit')}}"><i class="fas fa-edit"></i></a>
                    {!! Form::button('<i class="fas fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs','data-toggle' => 'tooltip', 'title' => trans('app.delete'), 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{$keywords->links()}}