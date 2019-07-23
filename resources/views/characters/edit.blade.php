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
               <div class="row">
                   {!! Form::model($character, ['route' => ['characters.update', $character->id], 'method' => 'patch','style'=>'width:100%','enctype' => 'multipart/form-data']) !!}

                        @include('characters.edit_fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@push('scripts')

@endpush