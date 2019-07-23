<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', trans('persons.name').':') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Last Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('last_name', trans('persons.last_name').':') !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
    <!-- Birth place Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('birth_place', trans('persons.birth_place').':') !!}
        {!! Form::text('birth_place', null, ['class' => 'form-control']) !!}
    </div>
   <!-- Birth Date Field -->
   <div class="form-group col-sm-6">
        {!! Form::label('birth_date',  trans('persons.birth_date').':') !!}
        {{ Form::date('birth_date', null,['class' => 'form-control']) }}
    </div>
    <!-- info Field -->
    <div class="form-group col-sm-12">
        {!! Form::label('info', trans('persons.info').':') !!}
        {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
    </div>
   
    <!-- Main Picture Field -->
    <div class="form-group col-sm-6">
    {!! Form::label('picture',  trans('titles.picture').':') !!}
        <input type="file" class="form-control" name="picture" accept="image/*"/>
    </div>
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('persons.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
