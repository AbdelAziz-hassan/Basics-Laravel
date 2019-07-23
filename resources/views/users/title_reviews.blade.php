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
                        <div class="">{{$title->title??$title->name}}</div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <img src="/{{$title->picture}}" width="67" height="96"/>
                            <span style="font-size:20px;">@lang('titles.all_reviews')</span>
                        </div>
                        <div class="info l-m bb">
                            {!!$title->description!!}
                        </div> 
                    </div>
                </div>
                <div class="card-header">@lang('titles.user_reviews')</div>
                <div class="card-body">
                    <div class="s">
                        @foreach($reviews as $key=>$review)
                            @include('users.comments')
                        @endforeach
                        {{$reviews->links()}}
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
    $('.remove_review').on('click',function(){
        url_first=$(this).attr('data-ref');
        $.post('/'+url_first+'/review/delete',{ slug:$(this).attr('data-slug') },function(data){
            
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