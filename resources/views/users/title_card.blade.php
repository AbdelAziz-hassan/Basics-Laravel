@foreach($titles  as $key=>$title)
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
                <img src="/{{$title->picture}}" alt="{{$title->title}}'s picture" width="150px" height="150px"> 
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-11">
                        <a href="/title/{{$title->slug}}">{{$title->title}}</a>
                        <div class="f-s-11">
                        {{$title->release_date?\Carbon\Carbon::parse($title->release_date)->format('D M Y'):'Not Set'}}
                        </div>
                        <div class="small-font">
                            <span class="fa fa-star {{$title->rate>=1?'checked':''}} "> {{$title->rate}}</span>
                        </div>
                        <div class="div small-font" >
                        {!! $title->description!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach