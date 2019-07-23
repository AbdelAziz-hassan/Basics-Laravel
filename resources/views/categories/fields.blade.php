<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', trans('categories.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 pull-right">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('categories.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
</div>
