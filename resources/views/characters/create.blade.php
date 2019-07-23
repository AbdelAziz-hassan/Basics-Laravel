@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            @lang('characters.character')
        </h1>
    </section>
    <div class="content">
        @include('partials.flash')
        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['route' => 'characters.store','style'=>'width:100%','enctype' => 'multipart/form-data']) !!}

                    @include('characters.fields')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@push('scripts')

@endpush