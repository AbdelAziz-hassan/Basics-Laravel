@extends('layouts.admin')
@push('head')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <section class="content-header">
        <h1>
            @lang('users.user')
        </h1>
    </section>
    <div class="content">
        @include('partials.flash')
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'users.store','style'=>'width:100%']) !!}

                    @include('users.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@endpush