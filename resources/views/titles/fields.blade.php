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
        {!! Form::select('category_ids[]', $categories, null, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
    </div>
    <!-- Keyword Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('keyword_ids',  trans('titles.keywords').':') !!}
        {!! Form::select('keyword_ids[]', $keywords, null, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
    </div>
    <!-- description Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('description', trans('titles.short_description').':') !!}
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
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
        <a href="{!! route('titles.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
