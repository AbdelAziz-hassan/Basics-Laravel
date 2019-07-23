<!-- keyword Field -->
<div class="form-group col-sm-6">
    {!! Form::label('keyword', trans('keywords.keyword').':') !!}
    {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 pull-right">
    {!! Form::submit(trans('app.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keywords.index') !!}" class="btn btn-default">@lang('app.cancel')</a>
</div>
