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
                        <div class="">{{$user->name}}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/{{$user->picture}}" width="67" height="96"/>
                            <span style="font-size:20px;">@lang('users.rated_titles') {{$user->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('users.reviews')</div>
                    @forelse($reviews as $key=>$review)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="/{{$review->picture}}" alt="{{$review->title}}'s picture" width="150" height="150px"> 
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-11">
                                        <a href="/title/{{$review->slug}}">{{$review->title}}</a>
                                        <div class="f-s-11">
                                        {{$review->release_date?\Carbon\Carbon::parse($review->release_date)->format('D M Y'):'Not Set'}}
                                        </div>
                                        <div class="small-font">
                                            <span class="fa fa-star {{$review->reviews->first()->rate>=1?'checked':''}} "> {{$review->rate}}</span>
                                        </div>
                                        <div class="div small-font" >
                                        {!! $review->reviews->first()->review!!}
                                        </div>
                                    </div>
                                    <div class="col-lg-1 release-date">
                                        @if(\Auth::user()&&\Auth::user()->id==$user->id)
                                        <div class="col-lg-">
                                            <div class="f-r">
                                                <button  class="close remove_review" data-slug="{{$review->slug}}" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="card-body">
                        <p>No Data</p>
                    </div>
                    @endforelse
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
        $.post('/title/review/delete',{ slug:$(this).attr('data-slug') },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        }).done(function(data) {
            window.location.reload(); 
        });
    })
</script>
@endpush