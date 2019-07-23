@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            @lang('groups.group')
        </h1>
   </section>
   <div class="content">
    @include('partials.flash')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($group, ['route' => ['groups.update', $group->id], 'method' => 'patch','style'=>'width:100%']) !!}

                        @include('groups.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection