@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Place
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($place, ['route' => ['places.update', $place->id], 'method' => 'patch']) !!}

                        @include('places.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection