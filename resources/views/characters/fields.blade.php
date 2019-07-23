<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', trans('persons.name').':') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- info Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('info', trans('persons.info').':') !!}
        {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
    </div>
   
    <!-- Pictures Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('pictures',  trans('titles.pictures').':') !!}
        <input type="file" class="form-control" name="pictures[]" accept="image/*" multiple/>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('characters.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
