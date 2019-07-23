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
        {!! Form::label('type',  trans('titles.type').':') !!}
        {!! Form::select('type', ['series'=>'Series','movie'=>'Movie'], old('type'), ['class' => 'form-control','placeholder'=>trans('titles.select_type')]) !!}
    </div>
    <!-- Release Date Field -->
     <div class="form-group col-sm-6">
        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
        {{ Form::date('release_date', null,['class' => 'form-control']) }}
    </div>
    <!-- Category Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('category_ids',  trans('titles.categories').':') !!}
        {!! Form::select('category_ids[]', $categories, old('category_ids[]')??$title->categories->pluck('id'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
    </div>
    <!-- Keyword Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('keyword_ids',  trans('titles.keywords').':') !!}
        {!! Form::select('keyword_ids[]', $keywords, old('keyword_ids[]')??$title->keywords->pluck('id'), ['class' => 'form-control select2','multiple'=>'multiple']) !!}
    </div>
    <!-- description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('titles.short_description').':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <!-- <img id="img" class="img" src="/{{$title->picture}}" alt="Title's image preview" /> -->
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('titles.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
