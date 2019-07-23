@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <section class="content-header">
        <h1 class="pull-left">@lang('titles.titles')</h1>
        
    </section>
    <div class="content">
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('titles.create') !!}">@lang('app.add_new')</a>
        </h1>
        <div class="clearfix"></div>
        @include('partials.flash')
        <div class="box">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('titles.index')}}" method="GET">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="title">@lang('titles.title')</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter title" value="{{app('request')->input('title')}}"> 
                            </div>
                            <div class="col-lg-3">
                                <label for="release_date">@lang('titles.before')</label>
                                <input class="form-control" type="date" name="release_date" placeholder="Date After" value="{{app('request')->input('release_date')}}"> 
                            </div>  
                            <div class="col-lg-3">
                                <label for="type">@lang('titles.type')</label>
                                {!! Form::select('type', ['series'=>'Series','movie'=>'Movie'], app('request')->input('type'), ['class' => 'form-control custom-select','placeholder'=>trans('titles.select_type')]) !!}
                            </div>     
                            <div class="col-lg-3">
                            {!! Form::label('category_ids',  trans('titles.categories').':') !!}
                            {!! Form::select('category_ids[]', $categories, null, ['class' => 'form-control select2','multiple'=>'multiple']) !!}
                            </div>                
                        </div>
                        <div style="text-align:right;margin-top:10px;">
                            <button type="submit" class="btn btn-primary">@lang('app.search')</button>
                        </div>
                    </form>
                </div>
            </div> 
        </div>
        <div class="clearfix"></div>
        <div class="box ">
            <div class="box-body">
                    @include('titles.table')
            </div>
        </div>
        <div class="text-center">
        
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@endpush