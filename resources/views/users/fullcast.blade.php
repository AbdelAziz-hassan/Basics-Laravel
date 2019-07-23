@extends('layouts.app')
@push('head')
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="row card-header m-0">
                    <div class="col-lg-8">
                        <div class="">{{$title->title}}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/{{$title->picture}}" width="67" height="96"/>
                            <span style="font-size:20px;">@lang('titles.fullcast_and_crew')</span>
                        </div>
                        <div class="info l-m bb">
                            {!!$title->description!!}
                        </div>                       
                        <div class="info">
                            <div class="div l-m">
                                <span>@lang('titles.director'):
                                    @foreach($director as $key=>$d)
                                        @if($key!=0)
                                        &
                                        @endif
                                        <a href="/name/{{$d->person->slug}}">{{$d->person->name}}</a>
                                    @endforeach
                                </span>
                            </div>
                            <div class="div l-m">
                                <span>@lang('titles.writer'):
                                    @foreach($writer as $key=>$w)
                                        @if($key!=0)
                                        &
                                        @endif
                                        <a href="/name/{{$w->person->slug}}">{{$w->person->name}}</a>
                                    @endforeach
                                </span>
                            </div>
                            <div class="div l-m">
                                @if($title->type=='series')
                                    <div>@lang('titles.seasons')</div>
                                    <div class="l-m-10">
                                        @foreach($title->seasons->sortBy('release_date') as $key=>$season)
                                            @if($key!= 0)
                                                |
                                            @endif
                                            <a href="/title/{{$title->slug}}/episodes?season={{$season->slug}}">{{$key+1}}</a>
                                        @endforeach
                                    </div>
                                @endif    
                            </div>
                            
                        </div>
                        <div class="clear-fix col-lg-12">
                          
                       </div>
                    </div>
                </div>
                <div class="card-header">@lang('casts.cast')</div>
                <div class="card-body">
                    <div class="container-fluid r-m">
                        <div class="row align-items-center ">
                            @foreach($stars as $star)
                                <div class="col-lg-2 m-b-5">
                                    <img src="/{{$star->person->picture}}" alt="{{$star->person->name}}'s picture" width="50px" height="50px"> 
                                </div>
                                <div class="col-lg-6 m-b-5">
                                    <a href="/name/{{$star->person->slug}}">{{$star->person->name}}</a>
                                </div>
                                @if($star->character)
                                    <div class="col-lg-4 m-b-5">
                                        <a href="/character/{{$star->character->slug}}">{{$star->character->name}}</a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @include('users.right_side')
    </div>
</div>
@endsection
@push('scripts')

@endpush