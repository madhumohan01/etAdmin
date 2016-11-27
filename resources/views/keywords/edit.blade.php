@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Keyword
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($keyword, ['route' => ['keywords.update', $keyword->id], 'method' => 'patch']) !!}

                        @include('keywords.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection