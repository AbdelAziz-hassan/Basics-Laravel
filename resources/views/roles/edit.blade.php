@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            @lang('roles.role')
        </h1>
   </section>
   <div class="content">
    @include('partials.flash')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'patch','style'=>'width:100%']) !!}

                        @include('roles.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection