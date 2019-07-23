@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            {{$title->title}}
        </h1>
    </section>
    <div class="clearfix"></div>
         @include('partials.flash')
    <div class="clearfix"></div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('titles.basic_info')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="seasons-tab" data-toggle="tab" href="#seasons" role="tab" aria-controls="seasons" aria-selected="false">@lang('titles.seasons')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cast-tab" data-toggle="tab" href="#cast" role="tab" aria-controls="cast" aria-selected="false">@lang('titles.cast_info')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="b-under"> @lang('titles.basic_info')</h4>
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('type',  trans('titles.type').':') !!}
                    <span class="span-info">{{$title->type}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('duration',  trans('titles.duration').':') !!}
                    <span class="span-info">{{ gmdate("H:i:s",$title->duration)}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('release_date',  trans('titles.release_date').':') !!}
                    <span class="span-info">{{$title->release_date}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('rate',  trans('titles.rate').':') !!}
                    <span class="span-info">{{ $title->rate}}<Span>
                </div>
                <div class="col-sm-12">
                    {!! Form::label('description',  trans('titles.short_description').':') !!}
                    <span class="span-info">{{ $title->description}}<Span>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="seasons" role="tabpanel" aria-labelledby="seasons-tab">
            <h4 class="b-under"> @lang('titles.seasons')</h4>
            <h1 class="pull-right">
            <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('seasons.create',['title_id'=>$title->id]) !!}">@lang('app.add_new')</a>
            </h1>
            <div class="">
                @include('seasons.table',['seasons'=>$title->seasons()->paginate(10)])
            </div>
        </div>
        <div class="tab-pane fade" id="cast" role="tabpanel" aria-labelledby="cast-tab">
            <h4 class="b-under"> @lang('titles.cast_info')</h4>
            <div class="row">
                
            </div>
        </div>
        <div class="col-sm-12 pull-right">
            <a href="{!! route('titles.index') !!}" class="btn btn-default">@lang('app.back')</a>
        </div>
    </div>
@endsection
