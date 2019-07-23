@extends('layouts.app')
@push('head')
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="container">
    @if($type=='all' && count($titles)==0 && count($keywords)==0 && count($names)==0)
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="row card-body m-0">
                    <div class="col-lg-8">
                        <div style="font-weight:bold;font-size:27px;" class="">
                            @lang('titles.no_results_for') "{{$search??'all'}}"
                        </div> 
                    </div>
                </div>
            </div>            
        </div>  
        <div class="col-md-4">
           @include('users.recent_added')
            <div class="clear-fix l-m"></div>
           @include('users.top_rated_gener')
        </div>      
    </div>
    
    @else
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="row card-header m-0">
                    <div class="col-lg-8">
                        <div style="font-weight:bold;font-size:27px;" class="">
                            @lang('titles.results_for') "{{$search??'all'}}"
                        </div> 
                        <div class="small-font">@lang('titles.search_category'): {{$type}}</div>
                    </div>
                </div>
                @if($type=='all'||$type=='titles')
                    <div class="card-body {{$type=='all'?'bb':''}}">
                        <div style="font-weight:bold;font-size:15px;" class="">
                            @lang('titles.titles')
                        </div> 
                        @foreach($titles  as $key=>$title)
                            <div class="row l-m gray-background">
                                <div class="col-lg-1 m-b-5">
                                    <img src="/{{$title->picture}}" alt="{{$title->title}}'s picture" width="30px" height="30px"> 
                                </div>
                                <div class="col-lg-10 m-b-5">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="/title/{{$title->slug}}">{{$title->title}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($type=='all')
                        <div class="row l-m gray-background">
                            <a style="font-size:small;" href="/find?search={{$search}}&type=titles">@lang('titles.view_all')</a>                    
                        </div>
                        @endif
                    </div>
                    @if($type!='all'&& $type=='titles')
                        <div class="col-lg-12 l-m">{{$titles->appends(request()->input())->links()}}</div>
                    @endif
                @endif
                @if($type=='all'||$type=='names')
                    <div class="card-body {{$type=='all'?'bb':''}}">
                        <div style="font-weight:bold;font-size:15px;" class="">
                            @lang('persons.persons')
                        </div> 
                        @foreach($names  as $key=>$name)
                            <div class="row l-m gray-background">
                                <div class="col-lg-1 m-b-5">
                                    <img src="/{{$name->picture}}" alt="{{$name->name}}'s picture" width="30px" height="30px"> 
                                </div>
                                <div class="col-lg-10 m-b-5">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="/name/{{$name->slug}}">{{$name->name}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($type=='all')
                        <div class="row l-m gray-background">
                            <a style="font-size:small;" href="/find?search={{$search}}&type=titles">@lang('titles.view_all')</a>                    
                        </div>
                        @endif
                    </div>
                    @if($type!='all'&& $type=='names')
                        <div class="col-lg-12 l-m">{{$names->appends(request()->input())->links()}}</div>
                    @endif
                @endif
                @if($type=='all'&&isset($keywords))
                    <div class="card-body">
                        <div style="font-weight:bold;font-size:15px;" class="">
                            @lang('keywords.keywords')
                        </div> 
                        @foreach($keywords  as $key=>$keyword)
                            <div class="row">
                                <div class="col-lg-4" style="margin-left:10px;">
                                    <a href="/find/?search={{$keyword->keyword}}&type=keywords">{{$keyword->keyword}}</a>
                                </div>
                            </div>
                        @endforeach
                        @if($type=='all')
                            <div class="row  gray-background" style="margin-left:10px;">
                                <div class="" >
                                    <a style="font-size:small;" href="/find?search={{$search}}&type=keywords_all">@lang('titles.view_all')</a>                    
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($type!='all'&& $type=='keywords')
                        <div class="col-lg-12 l-m">{{$keywords->appends(request()->input())->links()}}</div>
                    @endif
                @endif
                @if($type=='keywords_all')
                    <div class="card-body">
                        <div style="font-weight:bold;font-size:15px;" class="">
                            @lang('keywords.keywords')
                        </div> 
                        @foreach($keywords  as $key=>$keyword)
                            <div class="row">
                                <div class="col-lg-4" style="margin-left:10px;">
                                    <a href="/find/?search={{$keyword->keyword}}&type=keywords">{{$keyword->keyword}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if($type!='all'&& $type=='keywords')
                        <div class="col-lg-12 l-m">{{$keywords->appends(request()->input())->links()}}</div>
                    @endif
                @endif
            </div>
        </div>
        <div class="col-md-4">
           @include('users.recent_added')
            <div class="clear-fix l-m"></div>
            @include('users.top_rated_gener')
        </div>
    </div>
    @endif
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