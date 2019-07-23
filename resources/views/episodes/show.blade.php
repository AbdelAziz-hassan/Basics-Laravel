@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            {{$episode->title}}
        </h1>
    </section>
    <div class="clearfix"></div>
         @include('partials.flash')
    <div class="clearfix"></div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">@lang('titles.basic_info')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="b-under"> @lang('titles.basic_info')</h4>
            <div class="row">
                <div class="col-lg-6">
                    <img src="/{{$episode->picture}}" width="400" height="500">
                </div>
                <div class="col-lg-6">
                    <div class="col-sm-6">
                        {!! Form::label('duration',  trans('titles.duration').':') !!}
                        <span class="span-info">{{ gmdate("H:i:s",$episode->duration)}}<Span>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('release_date',  trans('titles.release_date').':') !!}
                        <span class="span-info">{{$episode->release_date}}<Span>
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('rate',  trans('titles.rate').':') !!}
                        <span class="span-info">{{ $episode->rate}}<Span>
                    </div>
                    <div class="col-sm-12">
                        {!! Form::label('description',  trans('titles.short_description').':') !!}
                        <span class="span-info">{{ $episode->description}}<Span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 pull-right">
            <a href="{!! route('seasons.show',$episode->season->id) !!}" class="btn btn-default">@lang('app.back')</a>
        </div>
    </div>
@endsection
