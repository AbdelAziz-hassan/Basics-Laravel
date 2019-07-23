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
        {!! Form::label('title_id',  trans('titles.series').':') !!}
        {!! Form::select('title_id', $titles, old('title_id')??$season->title_id, ['class' => 'form-control','placeholder'=>trans('titles.select_type')]) !!}
    </div>
    <!-- Release Date Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('episodes_numbers',  trans('titles.episodes_numbers').':') !!}
        {{ Form::number('episodes_numbers', null,['class' => 'form-control']) }}
    </div>
    <!-- description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('titles.short_description').':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Release Date Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
        {{ Form::date('release_date', null,['class' => 'form-control']) }}
    </div>
    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <!-- <br><img id="img" class="img" src="/{{$season->picture}}" alt="Season's image preview" /> -->
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('seasons.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
