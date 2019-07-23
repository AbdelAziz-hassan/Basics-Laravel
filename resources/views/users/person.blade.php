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
                        <div class="">{{$person->name}} {{$person->last_name}}</div>
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
                                @foreach($person->files as $key=>$file)
                                    <li data-target="#demo" data-slide-to="{{$key}}" class="{{$key==0?'active':''}}"></li>
                                @endforeach
                            </ul>

                            <!-- The slideshow -->
                            <div class="carousel-inner">
                                @foreach($person->files as $key=>$file)
                                @if($file->type =='image')
                                    <div class="carousel-item  {{$key==0?'active':''}}">
                                        <img src="/{{$file->path}}" alt="{{$person->name}}'s {{$key}} image" width="714" height="400">
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
                            {!!$person->info!!}
                        </div>                       
                        <div class="info l-m col-lg-12">
                            <div class="div">
                                <span>@lang('persons.birth_place'):
                                    <a>{{$person->birth_place}}</a>
                                </span>
                            </div>
                            <div class="div">
                                <span>@lang('persons.birth_date'):
                                    {{$person->birth_date?\Carbon\Carbon::parse($person->birht_date)->format('D M Y'):'Not set'}}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('persons.fimography')</div>
                <div class="card-body">
                    <div class="container-fluid r-m">
                        <div class="">
                            @foreach($casts as $cast)
                                <div class="row align-items-center">
                                    <div class="col-lg-1 m-b-5">
                                        <img src="/{{$cast->title->picture}}" alt="{{$cast->title->title}}'s picture" width="50px" height="50px"> 
                                    </div>
                                    <div class="col-lg-4 m-b-5">
                                        <a href="/title/{{$cast->title->slug}}">{{$cast->title->title}}</a>
                                    </div>
                                    <div class="col-lg-4 m-b-5">
                                        @if($cast->character)
                                            <a href="/character/{{$cast->character->slug}}">{{$cast->character->name}}</a>
                                        @endif
                                    </div>
                                    <div class="col-lg-3 m-b-5">
                                        {{$cast->title->release_date?\Carbon\Carbon::parse($cast->title->released_date)->format('Y'):'Not Set'}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('titles.user_reviews')</div>
                <div class="card-body">
                    <div class="row">
                        @foreach($person->reviews->take(4) as $review)
                            @include('users.comments',['title'=>$person])
                        @endforeach
                    </div>
                    @if(count($person->reviews)>4)
                    <div class="div ">
                         <a href="/person/{{$person->slug}}/reviews">@lang('titles.see_all_user_reviews') </a>
                    </div>
                    @endif
                    @if(count($person->reviews)>0)
                    <div class="bb"></div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-12 l-m ">
                        <a class="review_full-title">@lang('titles.review_this_title')</a> 
                        <form action="/person/{{$person->slug}}/review" method="POST">
                            @csrf
                            <div class="col-lg-12">
                                <textarea style="width:100%" id="review" name = "review" ></textarea>
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
    $('.remove_review').on('click',function(){
        $.post('/person/review/delete',{ slug:$(this).attr('data-slug') },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        }).done(function(data){
            window.location.reload();
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