@extends('layouts.admin')
@push('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
<section class="content-header">
        <h1 class="pull-left">@lang('persons.persons')</h1>
        
    </section>
    <div class="content">
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('persons.create') !!}">@lang('app.add_new')</a>
        </h1>
        <div class="clearfix"></div>
        @include('partials.flash')
        <div class="box">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('persons.index')}}" method="GET">
                        <div class="row">
                            <div class="col-lg-3">
                                <label for="name">@lang('persons.name')</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter name" value="{{app('request')->input('name')}}"> 
                            </div>
                            <div class="col-lg-3">
                                <label for="last_name">@lang('persons.last_name')</label>
                                <input class="form-control" type="text" name="last_name" placeholder="Enter title" value="{{app('request')->input('last_name')}}"> 
                            </div>
                            <div class="col-lg-3">
                                <label for="birth_date">@lang('persons.born_before')</label>
                                <input class="form-control" type="date" name="birth_date" placeholder="Date After" value="{{app('request')->input('birth_date')}}"> 
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
        <div class="box box-primary">
            <div class="box-body">
                    @include('persons.table')
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