<div class="row" style="width:100%;">
    <div class="col-md-12">
        <div class="media g-mb-30 media-comment">
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="/{{$review->user->picture}}" alt="Image Description">
            <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                @if(\Auth::user())
                @if(\Auth::user()->id == $review->user->id)
                <div class="f-r-" style="text-align:right">
                    <button class="remove_review close" data-ref="{{$ref??null}}" data-slug="{{$title->slug}}" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @endif
                <div class="g-mb-15">
                    <h5 class="h5 g-color-gray-dark-v1 mb-0"><a href="/user/{{$review->user->slug}}">{{$review->user->name}}</a></h5>
                    <span class="g-color-gray-dark-v4 g-font-size-12">{{$review->created_at->diffForHumans()}}</span>
                    </div>
                <div class="f-s-11">
                    <span class="fa fa-star {{$review->rate>=1?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=2?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=3?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=4?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=5?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=6?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=7?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=8?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=9?'checked':''}}"></span>
                    <span class="fa fa-star {{$review->rate>=10?'checked':''}}"></span>
                </div>
                <p>{{$review->review??'No comment'}}</p>
            </div>
        </div>
    </div>
   
</div>