@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            {{$person->name}}  {{$person->last_name}}
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
            <a class="nav-link" id="cast" data-toggle="tab" href="#filmography" role="tab" aria-controls="filmography" aria-selected="false">@lang('persons.fimography')</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="b-under"> @lang('titles.basic_info')</h4>
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('release_date',  trans('persons.name').':') !!}
                    <span class="span-info">{{$person->name}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('last_name',  trans('persons.last_name').':') !!}
                    <span class="span-info">{{ $person->last_name}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('birth_place',  trans('persons.birth_place').':') !!}
                    <span class="span-info">{{ $person->birth_place}}<Span>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('birth_date',  trans('persons.birth_date').':') !!}
                    <span class="span-info">{{ \Carbon\Carbon::parse($person->birth_date)->format('D M Y')}}<Span>
                </div>
                <div class="col-sm-12">
                    {!! Form::label('info',  trans('persons.info').':') !!}
                    <span class="span-info">{!! $person->info !!}<Span>
                </div>
            </div>
        </div>
        
        <div class="tab-pane fade" id="filmography" role="tabpanel" aria-labelledby="filmography-tab">
            <h4 class="b-under"> @lang('persons.fimography')</h4>
            <div class="row">
                
            </div>
        </div>
        <div class="col-sm-12 pull-right">
            <a href="{!! route('persons.index') !!}" class="btn btn-default">@lang('app.back')</a>
        </div>
    </div>
@endsection
