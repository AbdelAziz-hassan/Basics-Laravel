@extends('layouts.admin')
@push('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
    <section class="content-header">
        <h1 class="pull-left">@lang('characters.characters')</h1>
    </section>
    <div class="content">
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('characters.create') !!}">@lang('app.add_new')</a>
        </h1>
        <div class="clearfix"></div>
        <div class="box">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('characters.index')}}" method="GET">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="name">@lang('persons.name')</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter name" value="{{app('request')->input('name')}}"> 
                            </div>
                            <div class="col-lg-3">
                                <label for="title">@lang('titles.title')</label>
                                <input class="form-control" type="text" name="title" placeholder="Enter title" value="{{app('request')->input('title')}}"> 
                            </div>
                            <div class="col-lg-3">
                                <label for="birth_date">@lang('persons.person')</label>
                                <input class="form-control" type="text" name="person" placeholder="Enter person name" value="{{app('request')->input('person')}}"> 
                            </div>  
                        </div>
                        <div style="text-align:right;margin-top:10px;">
                            <button type="submit" class="btn btn-primary">@lang('app.search')</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        @include('partials.flash')
        <div class="clearfix"></div>
        <div class="box ">
            <div class="box-body">
                    @include('characters.table')
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endpush