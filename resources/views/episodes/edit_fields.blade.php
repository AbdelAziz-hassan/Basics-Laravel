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
    <div class="form-group col-sm-6">
        {!! Form::label('season_id',  trans('titles.season').':') !!}
        {!! Form::select('season_id', $seasons, old('season_id')??$episode->season->id, ['class' => 'form-control','placeholder'=>trans('titles.select_type')]) !!}
    </div>
    <!-- Release Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
        {{ Form::date('release_date', null,['class' => 'form-control']) }}
    </div>
    <!-- description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('titles.short_description').':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <!-- <br><img id="img" class="img" src="/{{$episode->picture}}" alt="Season's image preview" /> -->
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('seasons.show',$episode->season->id) !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
