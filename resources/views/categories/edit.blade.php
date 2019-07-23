@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            @lang('categories.category')
        </h1>
   </section>
   <div class="content">
    @include('partials.flash')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'patch','style'=>'width:100%']) !!}

                        @include('categories.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection