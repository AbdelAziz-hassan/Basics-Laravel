<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title', trans('titles.title').':') !!}
        {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>
    <!-- duration Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('duration', trans('titles.duration').':') !!}
        {!! Form::number('duration', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Type Field -->
   <input type="hidden" name="season_id" value="{{$season->id}}">
    <!-- description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('titles.short_description').':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Release Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
        {{ Form::date('release_date', null,['class' => 'form-control']) }}
    </div>
    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- Pictures Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('pictures',  trans('titles.pictures').':') !!}
        <input type="file" class="form-control" name="pictures[]" accept="image/*" multiple/>
    </div>
    <!-- Videos Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('videos',  trans('titles.videos').':') !!}
        <input type="file" class="form-control" name="videos[]" accept="video/mp4,video/x-m4v,video/*" multiple />
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('seasons.show',$season->id) !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
