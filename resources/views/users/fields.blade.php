<div class="row">
    <!-- name Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('name', trans('users.name').':') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('email', trans('users.email').':') !!}
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
    </div>

    <!-- email Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('group_ids', trans('users.groups').':') !!}
        {!! Form::select('group_ids[]', $groups, $user_groups, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12 pull-right">
        {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('users.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
    </div>
</div>
