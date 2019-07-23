<table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>@lang('titles.title')</th>
            <th>@lang('titles.type')</th>
            <th>@lang('characters.character')</th>
            <th>@lang('roles.role')</th>
            <th>@lang('titles.release_date')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($cast as $cast)
            <tr>
                <td><a href="/titles/{{$cast->title->id}}">{{$cast->title->title}}</a></td>
                <td>{{$cast->title->type}}</td>
                <td>{{$cast->character->name??'No Character'}}</td>
                <td>{{$cast->role->role}}</td>
                <td>{{\Carbon\Carbon::parse($cast->title->release_date)->format('D M Y')}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
