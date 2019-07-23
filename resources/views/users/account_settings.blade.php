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
                            <span style="font-size:20px;">{{$user->name}}</span>
                        </div>
                    </div>
                </div>
                <div class="card-header">@lang('users.user_data')</div>
                <div class="card-body">
                @if ($errors->has('email') || $errors->has('name') || Session::has('data_success'))
                    @include('partials.flash')
                @endif
                    <form action="/user/{{$user->id}}/update" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row m-b-5">
                            <div class="col-lg-6">
                                <label for="name">@lang('users.name'):</label>
                                <input type="text" style="width: 100%;"  name="name" value="{{old('name')??$user->name}}">
                            </div>
                          
                            <div class="col-lg-6">
                                <label for="email">@lang('users.email'):</label>
                                <input type="text" style="width: 100%;"  name="email" value="{{old('email')??$user->email}}">
                            </div>
                        </div>
                        <div class="row m-b-5">
                            <div class="col-lg-12" style="text-align:right;margin-top:5px;">
                                <button class="btn btn-primary">@lang('app.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">@lang('users.change_password')</div>
                <div class="card-body">
                @if ($errors->has('current_password') || $errors->has('password') ||Session::has('password_success'))
                    @include('partials.flash')
                @endif
                    <form action="/user/{{$user->id}}/change" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row m-b-5">
                            <div class="col-lg-6">
                                <label for="current_password">@lang('users.current_password'):</label>
                                <input type="password" style="width: 100%;"  name="current_password" value="{{null}}">
                            </div>
                            <div class="col-lg-6">
                                <label for="password">@lang('users.new_password'):</label>
                                <input type="password" style="width: 100%;" name="password" value="{{null}}">
                            </div>
                        </div>
                        <div class="row m-b-5">
                            <div class="col-lg-12" style="text-align:right;margin-top:5px;">
                                <button class="btn btn-primary">@lang('app.save')</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-header">@lang('users.change_profile_photo')</div>
                <div class="card-body">
                @if ($errors->has('file') || Session::has('photo_success') )
                    @include('partials.flash')
                @endif
                    <form action="/user/{{$user->id}}/photo" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="picture">@lang('users.picture'):</label>
                                <input type="file" style="width: 100%;"  name="file">
                            </div>
                        </div>
                        <div class="row m-b-5">
                            <div class="col-lg-12" style="text-align:right;margin-top:5px;">
                                <button class="btn btn-primary">@lang('app.save')</button>
                            </div>
                        </div>
                    </form>
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