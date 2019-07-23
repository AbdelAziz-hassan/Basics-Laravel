<!-- keyword Field -->
<div class="form-group col-sm-6">
    {!! Form::label('role', trans('roles.role').':') !!}
    {!! Form::text('role', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 pull-right">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
</div>
