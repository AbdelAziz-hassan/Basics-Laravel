<div class="row">
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('title_id',  trans('casts.title').':') !!}
        {!! Form::select('title_id', $titles, null, ['class' => 'form-control select2','placeholder'=>trans('casts.select_title')]) !!}
    </div>
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('person_id',  trans('casts.person').':') !!}
        {!! Form::select('person_id', $persons, null, ['class' => 'form-control select2','placeholder'=>trans('casts.select_person')]) !!}
    </div>
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('role_id',  trans('casts.role').':') !!}
        {!! Form::select('role_id', $roles, null, ['class' => 'form-control select2','placeholder'=>trans('casts.select_role')]) !!}
    </div>
    <!-- Name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('character_id',  trans('casts.character').':') !!}
        {!! Form::select('character_id', $characters, null, ['class' => 'form-control select2','placeholder'=>trans('casts.select_character')]) !!}
    </div>
   
    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('casts.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
