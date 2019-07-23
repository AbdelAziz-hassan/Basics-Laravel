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
                        <div class="small-font">@lang('titles.aflamk_chart')</div>
                        <div style="font-weight:bold;font-size:27px;" class="">
                            @lang('titles.top_rated_titles_by_gener')
                        </div> 
                        <p style="font-size:10px;margin-bottom:-10px;">@lang('titles.top_250_as_rated')</p>
                    </div>
                </div>
                @include('users.title_card')
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
    $('.rate-click').on('click',function(){
        $.post('/episode/review',{ slug:$(this).attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    $('.remove_review').on('click',function(){
        $.post('/episode/review/delete',{ slug:$(this).attr('data-slug'),rate: $(this).val() },function(data){
            
        }).fail(function(data) {
            if(data.status == 401)
                window.location.href = "/login";
        })
    })
    
</script>
@endpush