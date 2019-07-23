@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
            @include('partials.flash')

                <div class="card-header">@lang('home.recent_movies')</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($movies as $movie)
                            <div class="col-md-3 m_b">
                                <a href="/title/{{$movie->slug}}">
                                <img class="img-fluid size" src="/{{$movie->picture}}" alt="{{$movie->title}}'s movie picture">
                                <div class="caption center-block">{{$movie->title}}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-header">@lang('home.recent_serieses')</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($serieses as $series)
                            <div class="col-md-3 m_b">
                                <a href="/title/{{$series->slug}}">
                                <img class="img-fluid size" src="/{{$series->picture}}" alt="{{$series->title}}'s series picture">
                                <div class="caption center-block">{{$series->title}}</div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
