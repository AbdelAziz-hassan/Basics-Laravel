<div class="col-md-4">
    @include('users.recent_added')
    <div class="clear-fix l-m"></div>
    <div class="card">
        <div class="row card-header m-0">
            <div class="col-lg-8">
                @if($title->type=='movie')
                    <div class="">@lang('titles.top_rated')</div>
                @else
                    <div class="">@lang('titles.top_rated_serieses')</div>
                @endif
            </div>
        </div>
        <div class="card-body">
            @foreach($top_rated as $movie)
            <div class="row align-items-center m-b-5">
                <div class="col-lg-2">
                    <img src="/{{$movie->picture}}" width="50px" height="50px">
                </div>
                <div class="col-lg-4">
                    <p><a href="/title/{{$movie->slug}}">{{$movie->title}}</a></p>
                </div>
                <div class="col-lg-4">
                        <span class="fa fa-star {{$movie->rate>=1?'checked':''}}"></span>{{$movie->rate}}/10
                </div>
            </div>
            @endforeach
            <div class="bb"></div>
            @if($title->type=='movie')
                <a style="font-size:small;" href="/chart/top">@lang('titles.view_all')</a>
            @else
                <a style="font-size:small;" href="/chart/toptv">@lang('titles.view_all')</a>
            @endif
        </div>
    </div>
</div>