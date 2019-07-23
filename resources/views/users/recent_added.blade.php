<div class="card">
    <div class="row card-header m-0">
        <div class="col-lg-8">
            <div class="">@lang('titles.recent_added')</div>
        </div>
    </div>
    <div class="card-body">
        @foreach($recent_added as $recent)
        <div class="row align-items-center m-b-5">
            <div class="col-lg-2">
                <img src="/{{$recent->picture}}" width="50px" height="50px">
            </div>
            <div class="col-lg-4">
                <p><a href="/title/{{$recent->slug}}">{{$recent->title}}</a></p>
            </div>
            <div class="col-lg-4">
                    <span class="fa fa-star {{$recent->rate>=1?'checked':''}}"></span>{{$recent->rate}}/10
            </div>
        </div>
        @endforeach
    </div>
</div>