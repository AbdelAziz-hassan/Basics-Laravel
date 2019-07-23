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
                    <div class="col-lg-4 small-font">
                        <div class="f-s-11 text-right">
                            <span class="fa fa-star {{$title->rate>=1?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=2?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=3?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=4?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=5?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=6?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=7?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=8?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=9?'checked':''}}"></span>
                            <span class="fa fa-star {{$title->rate>=10?'checked':''}}"></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="demo" class="carousel slide" data-ride="carousel">

                            <!-- Indicators -->
                            <ul class="carousel-indicators">
                                @foreach($title->files as $key=>$file)
                                    <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
                                @endforeach
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @foreach($title->files as $key=>$file)
                                @if($file->type =='image')
                                    <div class="carousel-item  {{$key==0?'active':''}}">
                                        <img src="/{{$file->path}}" alt="{{$title->title}}'s {{$key}} image" width="718" height="400">
                                    </div>
                                @else
                                    <div class="carousel-item  {{$key==0?'active':''}}">
                                        <video class="video-fluid" autoplay loop muted  width="718" height="400">
                                            <source src="/{{$file->path}}" type="video/mp4" />
                                        </video>
                                    </div>
                                @endif
                                @endforeach
                            </div>

                            <!-- Left and right controls -->
                            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                            </a>
                            <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                            </a>
                        </div>
                        <div class="info l-m col-lg-12">
                            {!!$title->description!!}
                        </div>                       
                        <div class="info l-m">
                            <div class="div">
                                <span>@lang('titles.director'):
                                    @foreach($director as $key=>$d)
                                        @if($key!=0)
                                        &
                                        @endif
                                        <a href="/name/{{$d->person->slug}}">{{$d->person->name}}</a>
                                    @endforeach
                                </span>
                            </div>
                            <div class="div">
                                <span>@lang('titles.writer'):
                                    @foreach($writer as $key=>$w)
                                        @if($key!=0)
                                        &
                                        @endif
                                        <a href="/name/{{$w->person->slug}}">{{$w->person->name}}</a>
                                    @endforeach
                                </span>
                            </div>
                            <div class="div">
                                <span>@lang('titles.stars'):
                                    @foreach($stars->take(3) as $key=>$star)
                                        @if($key!=0)
                                        &
                                        @endif
                                        <a href="/name/{{$star->person->slug}}">{{$star->person->name}}</a>
                                    @endforeach
                                    <span>| <a href="/title/{{$title->slug}}/fullcast">@lang('titles.full_cast')</a></span>
                                </span>
                            </div>
                            <div class="clear-fix ">
                                @if($title->type=='series')
                                <div>
                                    <div>@lang('titles.seasons'):</div>
                                    <div>
                                        @foreach($title->seasons->sortBy('release_date') as $key=>$season)
                                            @if($key!= 0)
                                                |
                                            @endif
                                            <a href="/title/{{$title->slug}}/episodes?season={{$season->slug}}">{{$key+1}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                @endif    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('casts.cast')</div>
                <div class="card-body">
                    <div class="container-fluid r-m">
                        @foreach($stars as $star)
                        <div class="row align-items-center ">
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
                        </div>
                        @endforeach
                        @if(count($stars)==20)
                        <div class="bb"></div>
                        <div class="div lm" style="font-size:12px">
                            <a href="/title/{{$title->slug}}/fullcast">@lang('titles.see_full_cast')>></a></span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-header">@lang('titles.user_reviews')</div>
                <div class="card-body">
                    @foreach($title->reviews->take(4) as $key=>$review)
                        @include('users.comments')
                    @endforeach
                    @if(count($title->reviews)>4)
                    <div class="div">
                         <a href="/title/{{$title->slug}}/reviews">@lang('titles.see_all_user_reviews') </a>
                    </div>
                    @endif
                </div>
                @if(count($title->reviews)>0)
                    <div class="bb"></div>
                @endif
                <div class="row">
                    <div class="col-lg-12 l-m ">
                        <a class="review_full-title">@lang('titles.review_this_title')</a> 
                        <form action="/title/{{$title->slug}}/review" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-12">
                                <textarea style="width:100%" id="review" required="required" name = "review" ></textarea>
                            </div> 
                            <div class="col-lg-6 pull-right" style="text-align:right;margin-bottom:5px;margin-top:5px">
                                <span class="fa fa-star star_input checked " data-value="1"></span>
                                <span class="fa fa-star star_input " data-value="2"></span>
                                <span class="fa fa-star star_input " data-value="3"></span>
                                <span class="fa fa-star star_input " data-value="4"></span>
                                <span class="fa fa-star star_input " data-value="5"></span>
                                <span class="fa fa-star star_input " data-value="6"></span>
                                <span class="fa fa-star star_input " data-value="7"></span>
                                <span class="fa fa-star star_input " data-value="8"></span>
                                <span class="fa fa-star star_input " data-value="9"></span>
                                <span class="fa fa-star star_input " data-value="10"></span>
                            </div>
                            <input type="hidden" id="rate_val" value="1" name ="rate">
                            <div class="col-lg-12 pull-right">
                                <button class="btn btn-primary pull-right">@lang('app.save')</button>
                            </div>
                        </form>
                    </div>
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
    $('.remove_review').on('click',function(){
        $.post('/title/review/delete',{ slug:$(this).attr('data-slug') },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        }).done(function(data){
            window.location.reload();
        });
    })
    $(function() {
        $('#star'+$('.rating').attr('data-rate')).prop('checked',true);
    });
    $('.star_input').on('click',function(){
        var value = $(this).attr('data-value');
        $(".star_input").removeClass('checked');
        
        for(i=1;i<=value;i++)
        {  
            $(".star_input[data-value='"+i+"']").addClass('checked');
        }
        $('#rate_val').val(value);
    });
    
</script>
@endpush