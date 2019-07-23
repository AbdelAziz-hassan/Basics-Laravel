<div class="card">
    <div class="row card-header m-0">
        <div class="col-lg-8">
            <div class="">@lang('titles.top_rated_by_gener')</div>
        </div>
    </div>
    <div class="card-body">
        @foreach($categories as $cateogry)
        <div class="row align-items-center m-b-5">
            <div class="col-lg-12">
                <a href="/search/title/?categories={{$cateogry->slug}}&sort=rate">{{$cateogry->name}}</a>
            </div>
        </div>
        @endforeach
    </div>
</div>