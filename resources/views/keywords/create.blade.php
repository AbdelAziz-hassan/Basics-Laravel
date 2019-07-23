@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            @lang('keywords.keyword')
        </h1>
    </section>
    <div class="content">
        @include('partials.flash')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'keywords.store','style'=>'width:100%']) !!}

                        @include('keywords.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection