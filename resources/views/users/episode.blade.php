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
                        <div class="small-font">{{$title->title}}</div>
                        <div class="">{{$episode->title}}</div>
                    </div>
                    <div class="col-lg-4 small-font">
                        <div class="f-s-11 text-right">
                            <span class="fa fa-star {{$rate>=1?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=2?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=3?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=4?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=5?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=6?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=7?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=8?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=9?'checked':''}}"></span>
                            <span class="fa fa-star {{$rate>=10?'checked':''}}"></span>
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
                    @foreach($episode->reviews->take(4) as $key=>$review)
                        @include('users.comments')
                    @endforeach
                    @if(count($episode->reviews)>4)
                    <div class="div">
                         <a href="/title/{{$title->slug}}/reviews">@lang('titles.see_all_user_reviews') </a>
                    </div>
                    @endif
                </div>
                @if(count($episode->reviews)>0)
                    <div class="bb"></div>
                @endif
                <div class="row">
                    <div class="col-lg-12 l-m ">
                        <a class="review_full-title">@lang('titles.review_this_title')</a> 
                        <form action="/episode/{{$episode->slug}}/review" method="POST">
                            @csrf
                            <div class="col-lg-12">
                                <textarea style="width:100%" id="review" required="required" name = "review" ></textarea>
                            </div> 

                            <div class="col-lg-12" style="text-align:right">
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
                            <div class="col-lg-12">
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
    $('input[name="rating"]').on('click',function(){
        $.post('/title/review',{ slug:$('.rating').attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    $('#remove_review').on('click',function(){
        $.post('/title/review/delete',{ slug:$('.rating').attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
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