@extends('layouts.admin')
@push('head')
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
@endpush
@section('content')
    <section class="content-header">
        <h1 class="pull-left">@lang('categories.categories')</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('categories.create') !!}">@lang('app.add_new')</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('partials.flash')
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('categories.table')
            </div>
        </div>
        <div class="text-center">
        
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