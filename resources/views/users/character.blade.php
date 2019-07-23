@extends('layouts.app')
@push('head')
<!-- Font Awesome Icon Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row card-header m-0">
                    <div class="col-lg-8">
                        <div class="">{{$character->name}} {{$character->last_name}}</div>
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
                                @foreach($character->files as $key=>$file)
                                    <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
                                @endforeach
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @foreach($character->files as $key=>$file)
                                @if($file->type =='image')
                                    <div class="carousel-item  {{$key==0?'active':''}}">
                                        <img src="/{{$file->path}}" alt="{{$character->name}}'s {{$key}} image" width="714" height="400">
                                    </div>
                                @else
                                    <div class="carousel-item  {{$key==0?'active':''}}">
                                        <video class="video-fluid" autoplay loop muted  width="714" height="400">
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
                            {!!$character->info??'No Info'!!}
                        </div>                       
                    </div>
                </div>
                <div class="card-header">@lang('persons.fimography')</div>
                <div class="card-body">
                    <div class="container-fluid r-m">
                        <div class="">
                            @foreach($casts as $cast)
                                <div class="row align-items-center">
                                    <div class="col-lg-2 m-b-5">
                                        <img src="/{{$cast->title->picture}}" alt="{{$cast->title->title}}'s picture" width="50px" height="50px"> 
                                    </div>
                                    <div class="col-lg-5 m-b-5">
                                        <a href="/title/{{$cast->title->slug}}">{{$cast->title->title}}</a>
                                    </div>
                                    <div class="col-lg-5 m-b-5">
                                        <a href="/name/{{$cast->person->slug}}">{{$cast->person->name}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('titles.user_reviews')</div>
                <div class="card-body">
                    
                        @foreach($character->reviews->take(4) as $review)
                        @include('users.comments',['title'=>$character])       
                        @endforeach
                    
                    @if(count($character->reviews)>4)
                    <div class="div">
                         <a href="/character/{{$character->slug}}/reviews">@lang('titles.see_all_user_reviews') </a>
                    </div>
                    @endif
                    @if(count($character->reviews)>0)
                        <div class="bb"></div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12 l-m ">
                        <a class="review_full-title">@lang('titles.review_this_title')</a> 
                        <form action="/character/{{$character->slug}}/review" method="POST">
                            @csrf
                            <div class="col-lg-12">
                                <textarea style="width:100%" id="review" required="required" name = "review" ></textarea>
                            </div> 
                            <div class="col-lg-12" style="text-align:right;margin-bottom:5px;">
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
        <div class="col-md-4">
            @include('users.recent_added')
            <div class="clear-fix l-m"></div>
            @include('users.top_rated_gener')
        </div>
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
        $.post('/character/review',{ slug:$('.rating').attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    $('#remove_review').on('click',function(){
        $.post('/character/review/delete',{ slug:$('.rating').attr('data-slug'),rate: $(this).val() },function(data){
            
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