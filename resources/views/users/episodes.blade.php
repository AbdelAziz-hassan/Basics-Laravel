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
                            <span style="font-size:20px;">@lang('titles.episode_list')</span>
                        </div>
                        <div class="info l-m bb">
                            {!!$title->description!!}
                        </div> 
                    </div>
                </div>
                <div class="card-header">Season {{$season->title}}</div>
                @foreach($season->episodes  as $key=>$episode)
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="/{{$episode->picture}}" alt="{{$episode->title}}'s picture" width="150px" height="150px"> 
                        </div>
                        <div class="col-lg-9">
                            <div class="row">
                                <div class="col-lg-11">
                                    <a href="/title/{{$title->slug}}/episode/{{$episode->slug}}">{{$episode->title}}</a>
                                    <div class="f-s-11">
                                    {{$episode->release_date?\Carbon\Carbon::parse($episode->release_date)->format('D M Y'):'Not Set'}}
                                    </div>
                                    <div class="small-font">
                                        <span class="fa fa-star {{$episode->rate>=1?'checked':''}} "> {{$episode->rate}}</span>
                                    </div>
                                    <div class="div small-font" >
                                    {!! $episode->description!!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="row align-items-center small-font l-m-10">
                    @foreach($season_numbers as $key=>$t_season)
                        @if($key>0)
                            <span style="margin-left:5px;margin-right:5px;"> | </span> 
                        @endif
                        @if($season->slug==$t_season['slug'])
                            <span>@lang('titles.season') {{$key+1}}</span>
                        @else
                            <a href="/title/{{$title->slug}}/episodes?season={{$t_season['slug']}}">@lang('titles.season') {{$key+1}} </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        @include('users.right_side')
    </div>
</div>
@endsection
@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $('.rate-click').on('click',function(){
        $.post('/episode/review',{ slug:$(this).attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    $('.remove_review').on('click',function(){
        $.post('/episode/review/delete',{ slug:$(this).attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    
</script>
@endpush