@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            {{$season->title}}
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
            <a class="nav-link" id="episodes-tab" data-toggle="tab" href="#episodes" role="tab" aria-controls="episodes" aria-selected="false">@lang('titles.episodes')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="b-under"> @lang('titles.basic_info')</h4>
            <div class="row">
                <div class="col-lg-6">
                    <img src="/{{$season->picture}}" width="400" height="500">
                </div>
                <div class="col-lg-6">
                    <div class="col-sm-6">
                        {!! Form::label('duration',  trans('titles.duration').':') !!}
                        <span class="span-info">{{ gmdate("H:i:s",$season->duration)}}<Span>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
                        <span class="span-info">{{$season->release_date}}<Span>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('rate',  trans('titles.rate').':') !!}
                        <span class="span-info">{{ $season->rate}}<Span>
                    </div>
                    <div class="col-sm-12">
                        {!! Form::label('description',  trans('titles.short_description').':') !!}
                        <span class="span-info">{{ $season->description}}<Span>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="episodes" role="tabpanel" aria-labelledby="episodes-tab">
            <h4 class="b-under"> @lang('titles.episodes')</h4>
            <h1 class="pull-right">
            <a class="btn btn-primary" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('episodes.create',['season_id'=>$season->id]) !!}">@lang('app.add_new')</a>
            </h1>
            <div class="">
                @include('episodes.table',['episodes'=>$season->episodes()->paginate(10)])
            </div>
        </div>
        <div class="col-sm-12 pull-right">
            <a href="{!! route('titles.show',$season->series->id) !!}" class="btn btn-default">@lang('app.back')</a>
        </div>
    </div>
@endsection
